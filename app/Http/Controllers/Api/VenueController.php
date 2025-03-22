<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venue;
use App\Exceptions\CustomApiException;

class VenueController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        try {
            $venues = Venue::when($this->request->location, function ($query, $location) {
                    $query->where('location', $location);
                })
                ->when($this->request->capacity, function ($query, $capacity) {
                    $query->where('capacity', '>=', $capacity);
                })
                ->when($this->request->start_date && $this->request->end_date, function ($query) {
                    $query->whereDoesntHave('bookings', function ($q) {
                            $q->whereBetween('start_date', [$this->request->start_date, $this->request->end_date])
                              ->orWhereBetween('end_date', [$this->request->start_date, $this->request->end_date]);
                        })
                        ->whereDoesntHave('availabilities', function ($q) {
                            $q->whereBetween('blocked_date', [$this->request->start_date, $this->request->end_date]);
                        });
                })
                ->get();
    
            return response()->json(['success' => true, 'data' => $venues]);
        } catch (\Exception $e) {
            throw new CustomApiException($e->getMessage(), 500);
        }
    }
    
    public function show($id)
    {
        try {
            $venue = Venue::with(['bookings', 'availabilities'])->find($id);
            if (!$venue) {
                throw new CustomApiException("Venue not found", 404);
            }
            return response()->json(['success' => true, 'data' => $venue]);
        } catch (\Exception $e) {
            throw new CustomApiException($e->getMessage(), $e->getCode() ?: 500);
        }
    }

    public function store()
    {
        try {
            $validated = $this->request->validate([
                'name' => 'required|string',
                'location' => 'required|string',
                'capacity' => 'required|integer',
                'description' => 'nullable|string',
                'images' => 'nullable|json',
                'price' => 'nullable|numeric',
            ]);

            $venue = Venue::create($validated);
            return response()->json(['success' => true, 'data' => $venue], 201);
        } catch (\Exception $e) {
            throw new CustomApiException($e->getMessage(), 500);
        }
    }

    public function update($id)
    {
        try {
            $venue = Venue::find($id);
            if (!$venue) {
                throw new CustomApiException("Venue not found", 404);
            }

            $validated = $this->request->validate([
                'name' => 'sometimes|required|string',
                'location' => 'sometimes|required|string',
                'capacity' => 'sometimes|required|integer',
                'description' => 'nullable|string',
                'images' => 'nullable|json',
                'price' => 'nullable|numeric',
            ]);

            $venue->update($validated);
            return response()->json(['success' => true, 'data' => $venue]);
        } catch (\Exception $e) {
            throw new CustomApiException($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $venue = Venue::find($id);
            if (!$venue) {
                throw new CustomApiException("Venue not found", 404);
            }
            $venue->delete();

            return response()->json(['success' => true, 'message' => 'Venue deleted successfully']);
        } catch (\Exception $e) {
            throw new CustomApiException($e->getMessage(), 500);
        }
    }
}
