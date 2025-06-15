<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // Create a transaction
        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $request->amount,
            ],
            'customer_details' => [
                'first_name' => collect(explode(' ', $request->name))->slice(0, -1)->implode(' ') ?: $request->name,
                'last_name' => str_word_count($request->name) > 1 ? collect(explode(' ', $request->name))->last() : '',
                'email' => $request->email,
                'phone' => $request->phone,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('invoice', [
            'snapToken' => $snapToken,
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
