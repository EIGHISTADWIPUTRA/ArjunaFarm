<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Package;
use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::with('orderItems', 'payment');

        // Filter by status
        if ($request->has('status') && in_array($request->status, ['pending', 'paid', 'cancelled'])) {
            $query->where('payment_status', $request->status);
        }

        // Filter by date range
        if ($request->has('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Search by order number or customer name
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        $orders = $query->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load('orderItems.package', 'payment', 'reservation');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $order->load('orderItems.package', 'payment', 'reservation');
        $packages = Package::where('is_active', true)->get();
        return view('admin.orders.edit', compact('order', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'visit_date' => 'required|date|after_or_equal:today',
            'payment_status' => 'required|in:pending,paid,cancelled',
        ]);

        $order->update($validated);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Pesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // Hapus orderItems terlebih dahulu (sebenarnya ini harusnya cascade, tapi untuk berjaga-jaga)
        $order->orderItems()->delete();

        // Hapus reservation jika ada
        if ($order->reservation) {
            $order->reservation->delete();
        }

        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Pesanan berhasil dihapus.');
    }

    public function create(Request $request)
    {
        // Validate package_id
        $packageId = $request->query('package_id');
        $package = Package::where('is_active', true)->findOrFail($packageId);

        return view('orders.create', [
            'package' => $package,
        ]);
    }

    public function store(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'quantity' => 'required|integer|min:1',
            'visit_date' => 'required|date|after:today',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            // Conditional validation for group bookings
            'institution_name' => 'required_if:package_type,rombongan|nullable|string|max:255',
            'contact_person' => 'required_if:package_type,rombongan|nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Get package
        $package = Package::findOrFail($validated['package_id']);

        // Check minimum participants
        if ($package->min_participants > $validated['quantity']) {
            return redirect()->back()->withErrors(['quantity' => "This package requires a minimum of {$package->min_participants} participants."])->withInput();
        }

        // Calculate price
        $price = $package->getDiscountedPrice();
        $subtotal = $price * $validated['quantity'];

        // Start database transaction
        DB::beginTransaction();

        try {
            // Create order
            $order = new Order();
            $order->order_number = 'ARJ-' . strtoupper(Str::random(8));
            $order->customer_name = $validated['customer_name'];
            $order->customer_email = $validated['customer_email'];
            $order->customer_phone = $validated['customer_phone'];
            $order->visit_date = $validated['visit_date'];
            $order->total_price = $subtotal;
            $order->payment_status = 'pending';
            $order->save();

            // Create order item
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->package_id = $package->id;
            $orderItem->quantity = $validated['quantity'];
            $orderItem->price = $price;
            $orderItem->subtotal = $subtotal;
            $orderItem->save();

            // Create reservation for group bookings if applicable
            if ($package->type === 'rombongan') {
                $reservation = new Reservation();
                $reservation->order_id = $order->id;
                $reservation->institution_name = $validated['institution_name'];
                $reservation->contact_person = $validated['contact_person'];
                $reservation->notes = $validated['notes'] ?? null;
                $reservation->save();
            }

            DB::commit();

            // Redirect to payment page
            return redirect()->route('orders.payment', $order->order_number);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'There was an error processing your booking. Please try again.')->withInput();
        }
    }

    public function payment($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        // If order is already paid, redirect to confirmation
        if ($order->payment_status === 'paid') {
            return redirect()->route('orders.confirmation', $order->order_number);
        }

        return view('orders.payment', [
            'order' => $order,
            'orderItems' => $order->orderItems()->with('package')->get()
        ]);
    }

    public function confirmation($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        return view('orders.confirmation', [
            'order' => $order,
            'orderItems' => $order->orderItems()->with('package')->get()
        ]);
    }
}
