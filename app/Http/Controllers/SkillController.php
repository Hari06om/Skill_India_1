<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of skills
     */
    public function index()
    {
        $skills = Skill::paginate(50);

        return response()->json([
            'message' => 'Skills retrieved successfully',
            'data' => $skills
        ], 200);
    }

    /**
     * Store a new skill
     */
    public function store(Request $request)
    {
        if ($request->user()->user_type !== 'admin') {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:skills',
            'category' => 'required|string|max:255',
            'description' => 'sometimes|string',
        ]);

        $skill = Skill::create($validated);

        return response()->json([
            'message' => 'Skill created successfully',
            'data' => $skill
        ], 201);
    }

    /**
     * Display the specified skill
     */
    public function show(string $id)
    {
        $skill = Skill::find($id);

        if (!$skill) {
            return response()->json([
                'message' => 'Skill not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Skill retrieved successfully',
            'data' => $skill
        ], 200);
    }

    /**
     * Update the specified skill
     */
    public function update(Request $request, string $id)
    {
        if ($request->user()->user_type !== 'admin') {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $skill = Skill::find($id);

        if (!$skill) {
            return response()->json([
                'message' => 'Skill not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255|unique:skills,name,' . $id,
            'category' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
        ]);

        $skill->update($validated);

        return response()->json([
            'message' => 'Skill updated successfully',
            'data' => $skill
        ], 200);
    }

    public function destroy(Request $request, string $id)
    {
        if ($request->user()->user_type !== 'admin') {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $skill = Skill::find($id);

        if (!$skill) {
            return response()->json([
                'message' => 'Skill not found'
            ], 404);
        }

        $skill->delete();

        return response()->json([
            'message' => 'Skill deleted successfully'
        ], 200);
    }

    /**
     * Search skills by name or category
     */
    public function search(Request $request)
    {
        $query = Skill::query();

        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('name', 'like', "%$keyword%")
                ->orWhere('category', 'like', "%$keyword%");
        }

        if ($request->has('category')) {
            $query->where('category', $request->input('category'));
        }

        $skills = $query->paginate(50);

        return response()->json([
            'message' => 'Search results retrieved',
            'data' => $skills
        ], 200);
    }


}
