<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue_id',
        'user_name',
        'user_email',
        'start_date',
        'end_date',
    ];

    // A booking belongs to a venue
    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}
