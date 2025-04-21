<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizer_id',
        'title',
        'description',
        'location',
        'start_date',
        'end_date',
        'duration',
        'price',
        'max_participants',
        'image',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class, 'organizer_id');
    }


    public function hotels()
    {
        return $this->belongsToMany(Hotel::class,'trip_hotels');
    }

    public function transports()
    {
        return $this->belongsToMany(Transport::class,'trip_transports');
    }

    public function activity()
    {
        return $this->belongsToMany(Activity::class,'trip_activity');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function highlights()
    {
        return $this->hasMany(Highlight::class);
    }

    // public function getAverageRatingAttribute()
    // {
    //     return $this->reviews()->avg('rating') ?? 0;
    // }

    // public function getSpotsLeftAttribute()
    // {
    //     $bookedSpots = $this->bookings()->sum('participants');
    //     return $this->max_participants - $bookedSpots;
    // }
}