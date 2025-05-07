<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trip_id',
        'status',
        'participants',
        'total_price',
        'payment_id',
        'notes',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'participants' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}