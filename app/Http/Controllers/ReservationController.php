<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Reservation::with('order');

        // Filter by institution name
        if ($request->has('institution')) {
            $query->where('institution_name', 'like', '%' . $request->institution . '%');
        }

        // Filter by order status
        if ($request->has('status') && in_array($request->status, ['pending', 'paid', 'cancelled'])) {
            $query->whereHas('order', function($q) use ($request) {
                $q->where('payment_status', $request->status);
            });
        }

        // Filter by date range
        if ($request->has('start_date')) {
            $query->whereHas('order', function($q) use ($request) {
                $q->whereDate('visit_date', '>=', $request->start_date);
            });
        }

        if ($request->has('end_date')) {
            $query->whereHas('order', function($q) use ($request) {
                $q->whereDate('visit_date', '<=', $request->end_date);
            });
        }

        $reservations = $query->latest()->paginate(10);
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        $reservation->load('order.orderItems.package', 'order.payment');
        return view('admin.reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $reservation->load('order');
        return view('admin.reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'institution_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $reservation->update($validated);

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Reservasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        // Hapus reservasi (Tidak akan menghapus order terkait)
        $reservation->delete();

        return redirect()->route('reservations.index')
            ->with('success', 'Reservasi berhasil dihapus.');
    }
}
