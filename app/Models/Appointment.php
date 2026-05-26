<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'trainer_id', 'scheduled_at', 'learning_goals', 'status'])]
class Appointment extends Model
{
    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    /**
     * Get the trainer for this appointment
     */
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    /**
     * Get the user who booked this appointment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
