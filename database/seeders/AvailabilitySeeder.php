<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Availability;

class AvailabilitySeeder extends Seeder
{
    public function run()
    {
        $availabilities = [
            [
                'venue_id'     => 1,
                'blocked_date' => '2025-05-10',
                'reason'       => 'Maintenance'
            ],
            [
                'venue_id'     => 2,
                'blocked_date' => '2025-06-20',
                'reason'       => 'Private event'
            ],
            [
                'venue_id'     => 3,
                'blocked_date' => '2025-07-25',
                'reason'       => 'Renovation'
            ],
        ];

        foreach ($availabilities as $availability) {
            Availability::create($availability);
        }
    }
}
