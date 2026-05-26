<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Job;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display all applications for the user
     */
    public function index(Request $request)
    {
        if ($request->user()->user_type === 'employer') {
            $applications = JobApplication::whereHas('job', function ($q) use ($request) {
                $q->where('posted_by', $request->user()->id);
            })->with('job', 'user')->paginate(15);
        } else {
            $applications = JobApplication::where('user_id', $request->user()->id)
                ->with('job', 'job.employer')
                ->paginate(15);
        }

        return response()->json([
            'message' => 'Applications retrieved successfully',
            'data' => $applications
        ], 200);
    }


    /**
     * Store a new job application
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'cover_letter' => 'sometimes|string',
            'additional_info' => 'sometimes|string',
        ]);

        // Check if already applied
        $existing = JobApplication::where('user_id', $request->user()->id)
            ->where('job_id', $validated['job_id'])
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'You have already applied for this job'
            ], 409);
        }

        $application = JobApplication::create([
            'user_id' => $request->user()->id,
            'job_id' => $validated['job_id'],
            'cover_letter' => $validated['cover_letter'] ?? null,
            'additional_info' => $validated['additional_info'] ?? null,
            'applied_at' => now(),
        ]);

        return response()->json([
            'message' => 'Application submitted successfully',
            'data' => $application
        ], 201);
    }

    /**
     * Display the specified application
     */
    public function show(Request $request, string $id)
    {
        $application = JobApplication::with('job', 'job.employer', 'user')->find($id);

        if (!$application) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        if ($application->user_id !== $request->user()->id && $application->job->posted_by !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        return response()->json([
            'message' => 'Application retrieved successfully',
            'data' => $application
        ], 200);
    }


    /**
     * Update the application status (employer only)
     */
    public function update(Request $request, string $id)
    {
        $application = JobApplication::with('job')->find($id);

        if (!$application) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        if ($application->job->posted_by !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,shortlisted,rejected,accepted,withdrawn',
        ]);

        $application->update([
            'status' => $validated['status'],
            'reviewed_at' => now(),
        ]);

        return response()->json([
            'message' => 'Application updated successfully',
            'data' => $application
        ], 200);
    }

    /**
     * Withdraw the application
     */
    public function destroy(Request $request, string $id)
    {
        $application = JobApplication::find($id);

        if (!$application) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        if ($application->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $application->delete();

        return response()->json([
            'message' => 'Application withdrawn successfully'
        ], 200);
    }
}
