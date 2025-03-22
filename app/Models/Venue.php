<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'capacity',
        'description', // Detailed venue description
        'images',      // Gallery of images (JSON)
        'price',       // Pricing information
    ];

    // A venue can have many bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // A venue can have many availabilities (blocked dates)
    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }
}
