<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // List all bookings
    public function index()
    {
        $bookings = Booking::with('venue')->get();
        return response()->json($bookings);
    }

    // Show a specific booking
    public function show($id)
    {
        $booking = Booking::with('venue')->find($id);
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }
        return response()->json($booking);
    }

    // Create a new booking
    public function store()
    {
        $validated = $this->request->validate([
            'venue_id'   => 'required|exists:venues,id',
            'user_name'  => 'required|string',
            'user_email' => 'required|email',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        // Check for overlapping bookings (conflict check)
        $conflict = Booking::where('venue_id', $validated['venue_id'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                      ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']]);
            })->exists();

        if ($conflict) {
            return response()->json(['message' => 'Booking conflict detected'], 422);
        }

        $booking = Booking::create($validated);
        return response()->json($booking, 201);
    }

    // Update an existing booking
    public function update($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $validated = $this->request->validate([
            'venue_id'   => 'sometimes|required|exists:venues,id',
            'user_name'  => 'sometimes|required|string',
            'user_email' => 'sometimes|required|email',
            'start_date' => 'sometimes|required|date',
            'end_date'   => 'sometimes|required|date|after_or_equal:start_date',
        ]);

        $booking->update($validated);
        return response()->json($booking);
    }

    // Delete a booking
    public function destroy($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }
        $booking->delete();
        return response()->json(['message' => 'Booking deleted successfully']);
    }
}
