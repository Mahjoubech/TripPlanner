<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizer_id',
        'type',
        'company',
        'details',
        'capacity',
        'features',
        'image',
    ];

    protected $casts = [
        'features' => 'json',
        'capacity' => 'integer',
    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function trips()
    {
        return $this->belongsToMany(Trip::class);
    }
}