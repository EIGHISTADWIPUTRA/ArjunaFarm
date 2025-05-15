<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'institution_name',
        'contact_person',
        'notes',
    ];

    /**
     * Get the order associated with the reservation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Check if reservation is for a school.
     *
     * @return bool
     */
    public function isSchool(): bool
    {
        if (empty($this->institution_name)) {
            return false;
        }

        $schoolKeywords = ['sekolah', 'sd', 'smp', 'sma', 'smk', 'madrasah', 'tk', 'paud', 'school'];

        foreach ($schoolKeywords as $keyword) {
            if (stripos($this->institution_name, $keyword) !== false) {
                return true;
            }
        }

        return false;
    }
}
