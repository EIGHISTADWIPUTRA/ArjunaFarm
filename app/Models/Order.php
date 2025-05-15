<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'visit_date',
        'total_price',
        'payment_status',
        'qr_code',
        'payment_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'visit_date' => 'date',
        'total_price' => 'decimal:2',
    ];

    /**
     * Get all items for this order
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the payment associated with this order
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Get the reservation associated with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reservation()
    {
        return $this->hasOne(Reservation::class);
    }

    /**
     * Generate a random order number
     */
    public static function generateOrderNumber(): string
    {
        $prefix = 'ORD-';
        $randomPart = mt_rand(1000000, 9999999);
        $timestamp = now()->format('ymd');

        return $prefix . $timestamp . $randomPart;
    }

    /**
     * Calculate the total price from all order items.
     *
     * @return float
     */
    public function calculateTotalPrice(): float
    {
        return $this->orderItems->sum('subtotal');
    }

    /**
     * Scope a query to only include pending orders.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('payment_status', 'pending');
    }

    /**
     * Scope a query to only include paid orders.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePaid(Builder $query): Builder
    {
        return $query->where('payment_status', 'paid');
    }

    /**
     * Get formatted total price with Rp.
     *
     * @return string
     */
    public function getFormattedTotalPrice(): string
    {
        return 'Rp ' . number_format($this->getOriginal('total_price'), 0, ',', '.');
    }
}
