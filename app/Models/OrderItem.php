<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'package_id',
        'quantity',
        'price',
        'subtotal',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'quantity' => 'integer',
    ];

    /**
     * Get the order that owns the order item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the package that owns the order item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Calculate the subtotal based on quantity and price.
     *
     * @return float
     */
    public function calculateSubtotal(): float
    {
        return $this->quantity * $this->getOriginal('price');
    }

    /**
     * Update subtotal when saving.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($orderItem) {
            $orderItem->subtotal = $orderItem->calculateSubtotal();
        });

        static::updating(function ($orderItem) {
            $orderItem->subtotal = $orderItem->calculateSubtotal();
        });
    }

    /**
     * Get formatted price with Rp.
     *
     * @return string
     */
    public function getFormattedPrice(): string
    {
        return 'Rp ' . number_format($this->getOriginal('price'), 0, ',', '.');
    }

    /**
     * Get formatted subtotal with Rp.
     *
     * @return string
     */
    public function getFormattedSubtotal(): string
    {
        return 'Rp ' . number_format($this->getOriginal('subtotal'), 0, ',', '.');
    }
}
