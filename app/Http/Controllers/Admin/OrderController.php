<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the orders.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Order::with(['payment']);

        // Search by order number or customer name
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        // Filter by payment status
        if ($request->has('status') && in_array($request->input('status'), ['pending', 'paid', 'cancelled'])) {
            $query->where('payment_status', $request->input('status'));
        }

        // Filter by date range
        if ($request->has('from_date') && $request->has('to_date')) {
            $query->whereBetween('created_at', [
                $request->input('from_date') . ' 00:00:00',
                $request->input('to_date') . ' 23:59:59'
            ]);
        } elseif ($request->has('from_date')) {
            $query->where('created_at', '>=', $request->input('from_date') . ' 00:00:00');
        } elseif ($request->has('to_date')) {
            $query->where('created_at', '<=', $request->input('to_date') . ' 23:59:59');
        }

        // Sort by column
        $sortColumn = $request->input('sort', 'created_at');
        $sortDirection = $request->input('direction', 'desc');

        if (in_array($sortColumn, ['order_number', 'customer_name', 'total_price', 'payment_status', 'created_at'])) {
            $query->orderBy($sortColumn, $sortDirection === 'asc' ? 'asc' : 'desc');
        }

        $orders = $query->paginate(15)->appends($request->query());

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        $order->load(['orderItems.package', 'payment', 'reservation']);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the status of an order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        $order->payment_status = $request->input('status');
        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * Validate a payment manually.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function validatePayment(Request $request, Order $order)
    {
        $request->validate([
            'payment_type' => 'required|string|max:50',
            'payment_details' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Create payment record if not exists
            if (!$order->payment) {
                $payment = Payment::create([
                    'payment_type' => $request->input('payment_type'),
                    'gross_amount' => $order->total_price,
                    'transaction_time' => now(),
                    'transaction_status' => 'settlement',
                    'payment_details' => ['notes' => $request->input('payment_details')],
                ]);

                $order->payment_id = $payment->id;
            } else {
                $order->payment->update([
                    'payment_type' => $request->input('payment_type'),
                    'transaction_status' => 'settlement',
                    'payment_details' => ['notes' => $request->input('payment_details')],
                ]);
            }

            // Update order status
            $order->payment_status = 'paid';

            // Generate QR Code if not exists
            if (!$order->qr_code) {
                $order->qr_code = $this->generateQrCode($order);
            }

            $order->save();

            DB::commit();

            return back()->with('success', 'Pembayaran berhasil divalidasi.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memvalidasi pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * Generate ticket with QR code.
     *
     * @param  \App\Models\Order  $order
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function generateTicket(Order $order)
    {
        if ($order->payment_status !== 'paid') {
            return back()->with('error', 'Tidak dapat menghasilkan tiket untuk pesanan yang belum dibayar.');
        }

        // Ensure order has QR code
        if (!$order->qr_code) {
            $order->qr_code = $this->generateQrCode($order);
            $order->save();
        }

        $order->load(['orderItems.package', 'reservation']);

        $pdf = Pdf::loadView('admin.orders.ticket', compact('order'));
        return $pdf->download('ticket-' . $order->order_number . '.pdf');
    }

    /**
     * Export selected orders to Excel/PDF.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportOrders(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:orders,id',
            'format' => 'required|in:pdf,excel',
        ]);

        $orders = Order::with(['orderItems.package', 'payment'])
            ->whereIn('id', $request->input('ids'))
            ->get();

        if ($request->input('format') === 'pdf') {
            $pdf = Pdf::loadView('admin.orders.export', compact('orders'));
            return $pdf->download('orders-export-' . now()->format('Y-m-d') . '.pdf');
        } else {
            // Excel export implementation would go here
            // return (new OrdersExport($orders))->download('orders-export-' . now()->format('Y-m-d') . '.xlsx');
        }
    }

    /**
     * Generate QR code for the order.
     *
     * @param  \App\Models\Order  $order
     * @return string
     */
    protected function generateQrCode(Order $order): string
    {
        $data = [
            'order_number' => $order->order_number,
            'customer_name' => $order->customer_name,
            'visit_date' => $order->visit_date->format('Y-m-d'),
            'total_people' => $order->orderItems->sum('quantity'),
        ];

        $qrCode = QrCode::format('png')
            ->size(200)
            ->generate(json_encode($data));

        $filename = 'qrcodes/' . $order->order_number . '.png';

        // Store QR code image
        Storage::disk('public')->put($filename, $qrCode);

        return $filename;
    }
}
