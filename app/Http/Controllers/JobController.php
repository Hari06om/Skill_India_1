<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of jobs
     */
    public function index()
    {
        $jobs = Job::with('employer')->where('is_active', true)->paginate(15);

        return response()->json([
            'message' => 'Jobs retrieved successfully',
            'data' => $jobs
        ], 200);
    }


    /**
     * Store a newly created job
     */
    public function store(Request $request)
    {
        if ($request->user()->user_type !== 'employer') {
            return response()->json([
                'message' => 'Only employers can post jobs'
            ], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'job_type' => 'required|in:full-time,part-time,contract,freelance',
            'salary_range' => 'sometimes|string',
            'required_skills' => 'sometimes|array',
            'experience_level' => 'sometimes|in:entry,mid,senior',
            'number_of_positions' => 'sometimes|integer|min:1',
            'application_deadline' => 'sometimes|date',
        ]);

        $job = Job::create([
            ...$validated,
            'posted_by' => $request->user()->id,
        ]);

        return response()->json([
            'message' => 'Job created successfully',
            'data' => $job
        ], 201);
    }

    /**
     * Display the specified job
     */
    public function show(string $id)
    {
        $job = Job::with('employer', 'applications.user')->find($id);

        if (!$job) {
            return response()->json([
                'message' => 'Job not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Job retrieved successfully',
            'data' => $job
        ], 200);
    }


    /**
     * Update the specified job
     */
    public function update(Request $request, string $id)
    {
        $job = Job::find($id);

        if (!$job) {
            return response()->json([
                'message' => 'Job not found'
            ], 404);
        }

        if ($job->posted_by !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'location' => 'sometimes|string|max:255',
            'job_type' => 'sometimes|in:full-time,part-time,contract,freelance',
            'salary_range' => 'sometimes|string',
            'required_skills' => 'sometimes|array',
            'experience_level' => 'sometimes|in:entry,mid,senior',
            'is_active' => 'sometimes|boolean',
        ]);

        $job->update($validated);

        return response()->json([
            'message' => 'Job updated successfully',
            'data' => $job
        ], 200);
    }

    /**
     * Remove the specified job
     */
    public function destroy(Request $request, string $id)
    {
        $job = Job::find($id);

        if (!$job) {
            return response()->json([
                'message' => 'Job not found'
            ], 404);
        }

        if ($job->posted_by !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $job->delete();

        return response()->json([
            'message' => 'Job deleted successfully'
        ], 200);
    }

    /**
     * Search jobs by keyword
     */
    public function search(Request $request)
    {
        $query = Job::where('is_active', true);

        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%$keyword%")
                    ->orWhere('description', 'like', "%$keyword%");
            });
        }

        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }

        $jobs = $query->paginate(15);

        return response()->json([
            'message' => 'Search results retrieved',
            'data' => $jobs
        ], 200);
    }

    /**
     * Filter jobs
     */
    public function filter(Request $request)
    {
        $query = Job::where('is_active', true);

        if ($request->has('job_type')) {
            $query->where('job_type', $request->input('job_type'));
        }

        if ($request->has('experience_level')) {
            $query->where('experience_level', $request->input('experience_level'));
        }

        $jobs = $query->paginate(15);

        return response()->json([
            'message' => 'Filtered jobs retrieved',
            'data' => $jobs
        ], 200);
    }

    /**
     * Get employer's job listings
     */
    public function employerListings(Request $request)
    {
        $jobs = Job::where('posted_by', $request->user()->id)->withCount('applications')->paginate(15);

        return response()->json([
            'message' => 'Employer listings retrieved',
            'data' => $jobs
        ], 200);
    }
}
