<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\Appointment;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    /**
     * Get all trainers
     */
    public function index()
    {
        $trainers = Trainer::all();

        return response()->json([
            'message' => 'Trainers retrieved successfully',
            'data' => $trainers
        ], 200);
    }

    /**
     * Book an appointment with a trainer
     */
    public function bookAppointment(Request $request)
    {
        $validated = $request->validate([
            'trainer_id' => 'required|exists:trainers,id',
            'scheduled_at' => 'required|date_format:Y-m-d H:i',
            'learning_goals' => 'required|string|max:1000',
        ]);

        try {
            $appointment = Appointment::create([
                'user_id' => $request->user()->id,
                'trainer_id' => $validated['trainer_id'],
                'scheduled_at' => $validated['scheduled_at'],
                'learning_goals' => $validated['learning_goals'],
                'status' => 'pending',
            ]);

            return response()->json([
                'message' => 'Appointment booked successfully',
                'data' => $appointment->load('trainer')
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to book appointment',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all appointments for the logged-in user
     */
    public function userAppointments(Request $request)
    {
        $appointments = Appointment::where('user_id', $request->user()->id)
            ->with('trainer')
            ->get();

        return response()->json([
            'message' => 'User appointments retrieved successfully',
            'data' => $appointments
        ], 200);
    }
}
