<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue_id',
        'blocked_date',
        'reason',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}
