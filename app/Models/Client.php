<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends User
{
    use HasFactory;
    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->type = 'client';
            $model->approval_status = 'approved';
        });
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function favorites()
    {
        return $this->belongsToMany(Trip::class, 'favorites', 'user_id', 'trip_id');
    }
}