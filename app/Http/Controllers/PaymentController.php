<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$clientKey = config('midtrans.client_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createTransaction(Request $request)
    {
        $data = new \stdClass();
        $data->order_id = date('Ymd') . str_pad(Transaction::whereDate('created_at', now()->toDateString())->count() + 1, 3, '0', STR_PAD_LEFT);
        $data->total = $request->amount;
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;

        // Create a transaction
        $params = [
            'transaction_details' => [
                'order_id' => $data->order_id,
                'gross_amount' => $request->amount,
            ],
            'customer_details' => [
                'first_name' => collect(explode(' ', $request->name))->slice(0, -1)->implode(' ') ?: $request->name,
                'last_name' => str_word_count($request->name) > 1 ? collect(explode(' ', $request->name))->last() : '',
                'email' => $request->email,
                'phone' => $request->phone,
            ],
        ];
    
        Transaction::create([
            'order_id' => $data->order_id,
            'name' => $data->name,
            'phone' => $data->phone,
            'email' => $data->email,
            'status' => 'pending',
            'total_amount' => $data->total,
            'token' => Snap::getSnapToken($params),
            'secure_key' => Str::random(48),
        ]);

        $items = collect(json_decode($request->items))->where('quantity', '>', 0)->values()->all();
        $products = Product::whereIn('id', collect($items)->pluck('id'))->get();
        foreach ($products as $product) {
            $item = collect($items)->firstWhere('id', $product->id);
            $product->quantity = $item->quantity ?? 0;
            TransactionDetail::create([
                'transaction_id' => Transaction::where('order_id', $data->order_id)->first()->id,
                'product_id' => $product->id,
                'quantity' => $product->quantity,
            ]);
        }

        $transaction = Transaction::where('order_id', $data->order_id)->first();

        // Redirect to invoice page with order_id, so refreshing won't create a new transaction
        return redirect()->route('invoice.show', ['id' => $transaction->secure_key]);
    }

    public function showInvoice($id)
    {
        $transaction = Transaction::where('secure_key', $id)->first();
        if (!$transaction) abort(404, 'Transaction not found');

        $details = DB::table('transaction_details as td')
            ->select('td.transaction_id', 'p.name', 'p.description', 'p.price', 'td.quantity')
            ->where('td.transaction_id', $transaction->id)
            ->join('products as p', 'td.product_id', '=', 'p.id')
            ->get();

        return view('invoice', [
            'data' => $transaction,
            'order_details' => $details,
        ]);
    }

    public function handleResult(Request $request)
    {
        $result = json_decode($request->json_callback, true);

        // Simpan ke database, tampilkan halaman sukses, dll.
        return view('result', ['result' => $result]);
    }

    public function notificationHandler(Request $request)
    {
        $notification = new Notification();

        $transaction = $notification->transaction_status;
        $type = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraud = $notification->fraud_status;

        // Handle transaction status
        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO: set transaction status on your database to 'challenge'
                } else {
                    // TODO: set transaction status on your database to 'success'
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO: set transaction status on your database to 'success'
        } else if ($transaction == 'pending') {
            // TODO: set transaction status on your database to 'pending'
        } else if ($transaction == 'deny') {
            // TODO: set transaction status on your database to 'deny'
        } else if ($transaction == 'expire') {
            // TODO: set transaction status on your database to 'expire'
        } else if ($transaction == 'cancel') {
            // TODO: set transaction status on your database to 'cancel'
        }

        return;
    }
}
