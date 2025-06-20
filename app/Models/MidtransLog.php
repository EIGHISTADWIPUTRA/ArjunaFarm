<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MidtransLog extends Model
{
    protected $fillable = [
        'transaction_id', 'mt_status_code', 'mt_status_message',
        'mt_transaction_id', 'mt_order_id', 'mt_gross_amount',
        'mt_payment_type', 'mt_transaction_time',
        'mt_transaction_status', 'mt_fraud_status'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
