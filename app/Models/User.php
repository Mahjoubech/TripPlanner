<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject

{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'phone',
        'avatar',
        'bio',
        'CIN',
        'identification_document',
        'document_number',
        'is_document_verified',
        'approval_status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_document_verified' => 'boolean',
    ];
    public function isAdmin()
    {
        \Log::info('User type: ' . $this->type);
        return $this->type === 'admin';
    }
    public function getJWTIdentifier()
{
    return $this->getKey();
}

public function getJWTCustomClaims()
{
    return [];
}

public function bookings()
{
    return $this->hasMany(Booking::class);
}

}
