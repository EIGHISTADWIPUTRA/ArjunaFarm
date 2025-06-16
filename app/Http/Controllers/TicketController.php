<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function showTickets(Request $request)
    {
        $products = Product::all();
        $date = $request->query('date');
        return view('ticket', compact('date', 'products'));
    }
}
