<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Availability;

class AvailabilityController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // List all availabilities
    public function index()
    {
        $availabilities = Availability::with('venue')->get();
        return response()->json($availabilities);
    }

    // Block a date for a venue
    public function store()
    {
        $validated = $this->request->validate([
            'venue_id'     => 'required|exists:venues,id',
            'blocked_date' => 'required|date',
            'reason'       => 'nullable|string',
        ]);

        $availability = Availability::create($validated);
        return response()->json($availability, 201);
    }

    // Remove a blocked date
    public function destroy($id)
    {
        $availability = Availability::find($id);
        if (!$availability) {
            return response()->json(['message' => 'Availability not found'], 404);
        }
        $availability->delete();
        return response()->json(['message' => 'Availability removed successfully']);
    }
}
