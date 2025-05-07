<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

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

    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function bookings()
{
    return $this->hasMany(Booking::class, 'trip_id');
}

   
}