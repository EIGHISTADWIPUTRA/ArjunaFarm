<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Order;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the reservations.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Reservation::with('order');

        // Search by order number or institution name
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('institution_name', 'like', "%{$search}%")
                  ->orWhereHas('order', function($q) use ($search) {
                      $q->where('order_number', 'like', "%{$search}%");
                  });
        }

        // Filter by date
        if ($request->has('date')) {
            $date = $request->input('date');
            $query->whereHas('order', function($q) use ($date) {
                $q->whereDate('visit_date', $date);
            });
        }

        // Sort by column
        $sortColumn = $request->input('sort', 'created_at');
        $sortDirection = $request->input('direction', 'desc');

        if (in_array($sortColumn, ['created_at'])) {
            $query->orderBy($sortColumn, $sortDirection === 'asc' ? 'asc' : 'desc');
        }

        $reservations = $query->paginate(10)->appends(request()->query());

        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        return redirect()->route('reservations.index')
            ->with('error', 'Pembuatan reservasi manual tidak diizinkan. Reservasi dibuat otomatis dari pesanan yang sudah dibayar.');
    }

    /**
     * Store a newly created reservation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        return redirect()->route('reservations.index')
            ->with('error', 'Pembuatan reservasi manual tidak diizinkan. Reservasi dibuat otomatis dari pesanan yang sudah dibayar.');
    }

    /**
     * Display the specified reservation.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\View\View
     */
    public function show(Reservation $reservation)
    {
        $reservation->load('order.orderItems.package');

        return view('admin.reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified reservation.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\View\View
     */
    public function edit(Reservation $reservation)
    {
        $reservation->load('order');

        return view('admin.reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified reservation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'institution_name' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $reservation->update($validated);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservasi berhasil diperbarui.');
    }

    /**
     * Remove the specified reservation from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Reservation $reservation)
    {
        return redirect()->route('reservations.index')
            ->with('error', 'Penghapusan reservasi tidak diizinkan. Reservasi hanya bisa dihapus jika pesanannya dibatalkan.');
    }
}
