<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Exceptions\CustomApiException;

class BookingController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        try {
            $bookings = Booking::with('venue')->get();
            return response()->json(['success' => true, 'data' => $bookings]);
        } catch (\Exception $e) {
            throw new CustomApiException($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $booking = Booking::with('venue')->find($id);
            if (!$booking) {
                throw new CustomApiException("Booking not found", 404);
            }
            return response()->json(['success' => true, 'data' => $booking]);
        } catch (\Exception $e) {
            throw new CustomApiException($e->getMessage(), 500);
        }
    }

    public function store()
    {
        try {
            $validated = $this->request->validate([
                'venue_id'   => 'required|exists:venues,id',
                'user_name'  => 'required|string',
                'user_email' => 'required|email',
                'start_date' => 'required|date',
                'end_date'   => 'required|date|after_or_equal:start_date',
            ]);

            $conflict = Booking::where('venue_id', $validated['venue_id'])
                ->where(function ($query) use ($validated) {
                    $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                          ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']]);
                })->exists();

            if ($conflict) {
                throw new CustomApiException("Booking conflict detected", 422);
            }

            $booking = Booking::create($validated);
            return response()->json(['success' => true, 'data' => $booking], 201);
        } catch (\Exception $e) {
            throw new CustomApiException($e->getMessage(), $e->getCode() ?: 500);
        }
    }

    public function update($id)
    {
        try {
            $booking = Booking::find($id);
            if (!$booking) {
                throw new CustomApiException("Booking not found", 404);
            }

            $validated = $this->request->validate([
                'venue_id'   => 'sometimes|required|exists:venues,id',
                'user_name'  => 'sometimes|required|string',
                'user_email' => 'sometimes|required|email',
                'start_date' => 'sometimes|required|date',
                'end_date'   => 'sometimes|required|date|after_or_equal:start_date',
            ]);

            $booking->update($validated);
            return response()->json(['success' => true, 'data' => $booking]);
        } catch (\Exception $e) {
            throw new CustomApiException($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $booking = Booking::find($id);
            if (!$booking) {
                throw new CustomApiException("Booking not found", 404);
            }
            $booking->delete();

            return response()->json(['success' => true, 'message' => 'Booking deleted successfully']);
        } catch (\Exception $e) {
            throw new CustomApiException($e->getMessage(), 500);
        }
    }
}
