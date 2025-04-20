<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = 'activity';
     protected $fillable = [
        'name',
        'description',
        'location',
        'duration',
        'difficulty',
        'price',
        'image',
        'organizer_id',
    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
    public function trips()
    {
        return $this->belongsToMany(Trip::class , 'trip_activity');
    }
}