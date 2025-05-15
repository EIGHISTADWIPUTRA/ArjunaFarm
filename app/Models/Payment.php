<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'midtrans_transaction_id',
        'payment_type',
        'gross_amount',
        'transaction_time',
        'transaction_status',
        'payment_details',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'transaction_time' => 'datetime',
        'gross_amount' => 'decimal:2',
        'payment_details' => 'json',
    ];

    /**
     * Get the orders associated with the payment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Update status of the related orders based on payment status.
     *
     * @return bool
     */
    public function updateOrderStatus(): bool
    {
        $orders = $this->orders;

        if ($orders->isEmpty()) {
            return false;
        }

        DB::beginTransaction();
        try {
            foreach ($orders as $order) {
                if ($this->transaction_status === 'settlement' ||
                    $this->transaction_status === 'capture') {
                    $order->payment_status = 'paid';
                } elseif ($this->transaction_status === 'cancel' ||
                         $this->transaction_status === 'deny' ||
                         $this->transaction_status === 'expire') {
                    $order->payment_status = 'cancelled';
                } else {
                    $order->payment_status = 'pending';
                }

                $order->save();
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * Get formatted gross amount with Rp.
     *
     * @return string
     */
    public function getFormattedGrossAmount(): string
    {
        return 'Rp ' . number_format($this->getOriginal('gross_amount'), 0, ',', '.');
    }

    /**
     * Get the order associated with this payment
     */
    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
