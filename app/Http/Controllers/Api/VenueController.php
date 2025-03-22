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

    // List/Search venues
    public function index()
    {
        try {
            $venues = Venue::query();

            if ($this->request->has('location')) {
                $venues->where('location', $this->request->input('location'));
            }
            if ($this->request->has('capacity')) {
                $venues->where('capacity', '>=', $this->request->input('capacity'));
            }

            return response()->json([
                'success' => true,
                'data' => $venues->get(),
            ]);
        } catch (CustomApiException $e) {
            return $e->render($this->request);
        } catch (\Exception $e) {
            throw new CustomApiException("Error fetching venues: " . $e->getMessage(), 500);
        }
    }

    // Show a specific venue
    public function show($id)
    {
        try {
            $venue = Venue::with(['bookings', 'availabilities'])->find($id);
            if (!$venue) {
                throw new CustomApiException("Venue not found", 404);
            }
            return response()->json([
                'success' => true,
                'data' => $venue,
            ]);
        } catch (CustomApiException $e) {
            return $e->render($this->request);
        } catch (\Exception $e) {
            throw new CustomApiException($e->getMessage(), $e->getCode() ?: 500);
        }
    }

    // Create a new venue
    public function store()
    {
        try {
            $validated = $this->request->validate([
                'name' => 'required|string',
                'location' => 'required|string',
                'capacity' => 'required|integer',
                'description' => 'nullable|string',
                'images' => 'nullable|json', // Expecting a JSON array or JSON encoded string
                'price' => 'nullable|numeric',
            ]);

            $venue = Venue::create($validated);

            return response()->json([
                'success' => true,
                'data' => $venue,
            ], 201);
        } catch (CustomApiException $e) {
            return $e->render($this->request);
        } catch (\Exception $e) {
            throw new CustomApiException("Error creating venue: " . $e->getMessage(), 500);
        }
    }

    // Update an existing venue
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

            return response()->json([
                'success' => true,
                'data' => $venue,
            ]);
        } catch (CustomApiException $e) {
            return $e->render($this->request);
        } catch (\Exception $e) {
            throw new CustomApiException("Error updating venue: " . $e->getMessage(), 500);
        }
    }

    // Delete a venue
    public function destroy($id)
    {
        try {
            $venue = Venue::find($id);
            if (!$venue) {
                throw new CustomApiException("Venue not found", 404);
            }
            $venue->delete();

            return response()->json([
                'success' => true,
                'message' => 'Venue deleted successfully',
            ]);
        } catch (CustomApiException $e) {
            return $e->render($this->request);
        } catch (\Exception $e) {
            throw new CustomApiException("Error deleting venue: " . $e->getMessage(), 500);
        }
    }
}
