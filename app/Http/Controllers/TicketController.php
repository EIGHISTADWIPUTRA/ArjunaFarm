<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display the ticket selection page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tickets = Package::where('is_active', true)
                    ->where('type', 'personal')
                    ->get();

        return view('tiket', compact('tickets'));
    }

    /**
     * Download the ticket for a specific order.
     *
     * @param string $orderNumber
     * @return \Illuminate\Http\Response
     */
    public function download($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('payment_status', 'paid')
            ->firstOrFail();

        $order->load(['orderItems.package', 'reservation']);

        $pdf = Pdf::loadView('tickets.pdf', compact('order'));

        return $pdf->download('ticket-' . $order->order_number . '.pdf');
    }
}
