<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['title', 'description', 'location', 'job_type', 'salary_range', 'posted_by', 'required_skills', 'experience_level', 'number_of_positions', 'application_deadline', 'is_active'])]
class Job extends Model
{
    protected $casts = [
        'application_deadline' => 'date',
        'is_active' => 'boolean',
        'required_skills' => 'array',
    ];

    /**
     * Get the employer who posted this job
     */
    public function employer()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    /**
     * Get all applications for this job
     */
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
