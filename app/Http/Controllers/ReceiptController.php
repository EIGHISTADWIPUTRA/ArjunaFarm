<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    public function downloadReceipt($id)
    {
        // Find transaction by secure key
        $transaction = Transaction::where('secure_key', $id)->first();
        if (!$transaction) abort(404, 'Transaction not found');

        // Get transaction details
        $details = DB::table('transaction_details as td')
            ->select('td.transaction_id', 'p.name', 'p.description', 'p.price', 'td.quantity')
            ->where('td.transaction_id', $transaction->id)
            ->join('products as p', 'td.product_id', '=', 'p.id')
            ->get();

        // Create the PDF
        $pdf = PDF::loadView('pdf.payment_receipt', [
            'transaction' => $transaction,
            'details' => $details,
            'result' => [
                'order_id' => $transaction->order_id,
                'transaction_time' => $transaction->payment_time,
                'transaction_status' => $transaction->status,
                'payment_type' => $transaction->payment_type,
            ]
        ]);

        // Download the PDF
        return $pdf->download('bukti-pembayaran-AR' . $transaction->order_id . '.pdf');
    }
}
