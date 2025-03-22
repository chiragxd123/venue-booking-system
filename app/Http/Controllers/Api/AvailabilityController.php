<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Availability;
use App\Exceptions\CustomApiException;

class AvailabilityController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        try {
            $availabilities = Availability::with('venue')->get();
            return response()->json(['success' => true, 'data' => $availabilities]);
        } catch (\Exception $e) {
            throw new CustomApiException($e->getMessage(), 500);
        }
    }

    public function store()
    {
        try {
            $validated = $this->request->validate([
                'venue_id'     => 'required|exists:venues,id',
                'blocked_date' => 'required|date',
                'reason'       => 'nullable|string',
            ]);

            $availability = Availability::create($validated);
            return response()->json(['success' => true, 'data' => $availability], 201);
        } catch (\Exception $e) {
            throw new CustomApiException($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $availability = Availability::find($id);
            if (!$availability) {
                throw new CustomApiException("Availability not found", 404);
            }
            $availability->delete();

            return response()->json(['success' => true, 'message' => 'Availability removed successfully']);
        } catch (\Exception $e) {
            throw new CustomApiException($e->getMessage(), 500);
        }
    }
}
