<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    /**
     * Display all professionals
     */
    public function index()
    {
        $professionals = Professional::with('user')->paginate(15);

        return response()->json([
            'message' => 'Professionals retrieved successfully',
            'data' => $professionals
        ], 200);
    }


    /**
     * Store a new professional profile
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bio' => 'sometimes|string',
            'experience_years' => 'sometimes|integer|min:0',
            'location' => 'sometimes|string|max:255',
            'skills' => 'sometimes|array',
            'headline' => 'sometimes|string|max:255',
            'current_title' => 'sometimes|string|max:255',
            'portfolio_url' => 'sometimes|url',
            'linkedin_url' => 'sometimes|url',
            'github_url' => 'sometimes|url',
        ]);

        $professional = Professional::updateOrCreate(
            ['user_id' => $request->user()->id],
            $validated
        );

        return response()->json([
            'message' => 'Professional profile created/updated successfully',
            'data' => $professional
        ], 201);
    }

    /**
     * Display the specified professional profile
     */
    public function show(string $id)
    {
        $professional = Professional::with('user')->find($id);

        if (!$professional) {
            return response()->json([
                'message' => 'Professional profile not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Professional profile retrieved successfully',
            'data' => $professional
        ], 200);
    }


    /**
     * Update the specified professional profile
     */
    public function update(Request $request, string $id)
    {
        $professional = Professional::find($id);

        if (!$professional) {
            return response()->json([
                'message' => 'Professional profile not found'
            ], 404);
        }

        if ($professional->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'bio' => 'sometimes|string',
            'experience_years' => 'sometimes|integer|min:0',
            'location' => 'sometimes|string|max:255',
            'skills' => 'sometimes|array',
            'headline' => 'sometimes|string|max:255',
            'current_title' => 'sometimes|string|max:255',
            'portfolio_url' => 'sometimes|url',
            'linkedin_url' => 'sometimes|url',
            'github_url' => 'sometimes|url',
            'availability_status' => 'sometimes|in:available,not available',
            'notice_period' => 'sometimes|integer|min:0',
        ]);

        $professional->update($validated);

        return response()->json([
            'message' => 'Professional profile updated successfully',
            'data' => $professional
        ], 200);
    }


    /**
     * Search professionals by skills
     */
    public function search(Request $request)
    {
        $professionals = Professional::where('skills', 'like', '%' . $request->input('skill') . '%')
            ->paginate(15);

        return response()->json([
            'message' => 'Search results retrieved',
            'data' => $professionals
        ], 200);
    }
}
