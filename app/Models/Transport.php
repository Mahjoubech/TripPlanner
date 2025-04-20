<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;
protected $table = 'transports';
    protected $fillable = [
        'type',
        'company',
        'details',
        'capacity',
        'features',
        'image',
        'organizer_id',
    ];

    protected $casts = [
        'features' => 'array',
        'capacity' => 'integer',
    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function trips()
    {
        return $this->belongsToMany(Trip::class,'trip_transports');
    }
}