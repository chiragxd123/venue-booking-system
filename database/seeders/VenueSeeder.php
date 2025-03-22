<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venue;

class VenueSeeder extends Seeder
{
    public function run()
    {
        $venuesData = [
            [
                'name'        => 'Taj Banquet Hall',
                'location'    => 'Mumbai',
                'capacity'    => 300,
                'description' => 'An iconic banquet hall with luxury interiors and seaside views.',
                'images'      => json_encode([
                    "https://example.com/taj1.jpg",
                    "https://example.com/taj2.jpg"
                ]),
                'price'       => 20000.00
            ],
            [
                'name'        => 'Royal Palace Delhi',
                'location'    => 'New Delhi',
                'capacity'    => 500,
                'description' => 'A grand palace perfect for weddings and corporate events.',
                'images'      => json_encode([
                    "https://example.com/royalpalace1.jpg",
                    "https://example.com/royalpalace2.jpg"
                ]),
                'price'       => 30000.00
            ],
            [
                'name'        => 'Sunset Lawn Bangalore',
                'location'    => 'Bangalore',
                'capacity'    => 200,
                'description' => 'A beautiful lawn area with a serene view of the sunset.',
                'images'      => json_encode([
                    "https://example.com/sunset1.jpg",
                    "https://example.com/sunset2.jpg"
                ]),
                'price'       => 15000.00
            ],
            [
                'name'        => 'Imperial Grand Kolkata',
                'location'    => 'Kolkata',
                'capacity'    => 400,
                'description' => 'Heritage venue with modern amenities, located in central Kolkata.',
                'images'      => json_encode([
                    "https://example.com/imperial1.jpg",
                    "https://example.com/imperial2.jpg"
                ]),
                'price'       => 25000.00
            ],
            [
                'name'        => 'Emerald Convention Hyderabad',
                'location'    => 'Hyderabad',
                'capacity'    => 600,
                'description' => 'Massive convention center with state-of-the-art facilities.',
                'images'      => json_encode([
                    "https://example.com/emerald1.jpg",
                    "https://example.com/emerald2.jpg"
                ]),
                'price'       => 35000.00
            ],
            [
                'name'        => 'Lotus Garden Chennai',
                'location'    => 'Chennai',
                'capacity'    => 250,
                'description' => 'Open garden venue surrounded by lush greenery and a lotus pond.',
                'images'      => json_encode([
                    "https://example.com/lotus1.jpg",
                    "https://example.com/lotus2.jpg"
                ]),
                'price'       => 18000.00
            ],
            [
                'name'        => 'Pearl Arena Pune',
                'location'    => 'Pune',
                'capacity'    => 350,
                'description' => 'Modern hall with elegant decor, perfect for mid-sized events.',
                'images'      => json_encode([
                    "https://example.com/pearl1.jpg",
                    "https://example.com/pearl2.jpg"
                ]),
                'price'       => 22000.00
            ],
            [
                'name'        => 'Orchid Palace Jaipur',
                'location'    => 'Jaipur',
                'capacity'    => 450,
                'description' => 'A palace-inspired venue reflecting the royal heritage of Jaipur.',
                'images'      => json_encode([
                    "https://example.com/orchid1.jpg",
                    "https://example.com/orchid2.jpg"
                ]),
                'price'       => 28000.00
            ],
            [
                'name'        => 'Silk Terrace Ahmedabad',
                'location'    => 'Ahmedabad',
                'capacity'    => 300,
                'description' => 'Rooftop terrace with panoramic city views, ideal for receptions.',
                'images'      => json_encode([
                    "https://example.com/silk1.jpg",
                    "https://example.com/silk2.jpg"
                ]),
                'price'       => 20000.00
            ],
            [
                'name'        => 'Harmony Hall Lucknow',
                'location'    => 'Lucknow',
                'capacity'    => 500,
                'description' => 'Blends traditional Nawabi charm with modern facilities.',
                'images'      => json_encode([
                    "https://example.com/harmony1.jpg",
                    "https://example.com/harmony2.jpg"
                ]),
                'price'       => 30000.00
            ],
        ];

        foreach ($venuesData as $data) {
            Venue::create($data);
        }
    }
}
