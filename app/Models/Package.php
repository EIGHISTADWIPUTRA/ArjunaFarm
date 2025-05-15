<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'type',
        'price',
        'discount_percentage',
        'min_participants',
        'image',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'min_participants' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get the order items for the package.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get formatted price with Rp.
     *
     * @return string
     */
    public function getFormattedPrice()
    {
        return 'Rp ' . number_format($this->getRawOriginal('price'), 0, ',', '.');
    }

    /**
     * Get the raw price value.
     *
     * @return float
     */
    public function getRawPrice()
    {
        return (float)$this->getRawOriginal('price');
    }

    /**
     * Get the discounted price after applying discount percentage
     */
    public function getDiscountedPriceAttribute()
    {
        if ($this->discount_percentage > 0) {
            return $this->price * (1 - $this->discount_percentage / 100);
        }

        return $this->price;
    }

    /**
     * Get formatted discounted price with Rp.
     *
     * @return string
     */
    public function getFormattedDiscountedPrice()
    {
        return 'Rp ' . number_format($this->getDiscountedPriceAttribute(), 0, ',', '.');
    }
}
