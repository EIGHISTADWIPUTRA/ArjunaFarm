<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'name',
        'phone',
        'email',
        'status',
        'payment_type',
        'payment_time',
        'total_amount',
        'token',
        'secure_key',
    ];
}
