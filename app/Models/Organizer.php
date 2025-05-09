<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organizer extends User
{
    use HasFactory;
    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->type = 'organizer';
            $model->approval_status = 'pending'; 
            $model->is_document_verified = false;
        });
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'bio',
        'CIN',
        'document_number',
        'identification_document',
    ];

    public function isApproved()
    {
        return $this->approval_status === 'approved';
    }

    public function isPending()
    {
        return $this->approval_status === 'pending';
    }

    public function isRejected()
    {
        return $this->approval_status === 'rejected';
    }

    public function hasValidDocuments()
    {
        return !empty($this->identification_document) && 
               !empty($this->document_number) && 
               !empty($this->CIN) &&
               $this->is_document_verified;
    }

    public function organizedTrips()
    {
        return $this->hasMany(Trip::class, 'organizer_id');
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class, 'organizer_id');
    }

    public function transports()
    {
        return $this->hasMany(Transport::class, 'organizer_id');
    }

    public function activity()
    {
        return $this->hasMany(Activity::class, 'organizer_id');
    }
}