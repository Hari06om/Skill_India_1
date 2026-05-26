<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'expert_skill', 'rating', 'hourly_rate', 'availability', 'bio', 'avatar_char'])]
class Trainer extends Model
{
    /**
     * Get all appointments for this trainer
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
