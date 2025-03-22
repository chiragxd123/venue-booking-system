<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $bookings = [
            [
                'venue_id'   => 1,
                'user_name'  => 'Rahul Sharma',
                'user_email' => 'rahul@example.com',
                'start_date' => '2025-05-01',
                'end_date'   => '2025-05-03'
            ],
            [
                'venue_id'   => 2,
                'user_name'  => 'Anjali Gupta',
                'user_email' => 'anjali@example.com',
                'start_date' => '2025-06-10',
                'end_date'   => '2025-06-12'
            ],
            [
                'venue_id'   => 3,
                'user_name'  => 'Vikram Jain',
                'user_email' => 'vikram@example.com',
                'start_date' => '2025-07-15',
                'end_date'   => '2025-07-16'
            ],
        ];

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }
    }
}
