<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItineraryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'day',
        'title',
        'description',
        'location',
    ];

    protected $casts = [
        'day' => 'integer',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}