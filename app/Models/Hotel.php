<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizer_id',
        'name',
        'description',
        'address',
        'city',
        'country',
        'stars',
        'amenities',
        'image',
    ];

    protected $casts = [
        'amenities' => 'array',
        'stars' => 'integer',
    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function trips()
    {
        return $this->belongsToMany(Trip::class,'trip_hotels');
    }
}