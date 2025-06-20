<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'facility',
        'price',
        'image',
    ];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
