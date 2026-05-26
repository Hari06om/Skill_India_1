<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'job_id', 'status', 'cover_letter', 'additional_info', 'applied_at', 'reviewed_at'])]
class JobApplication extends Model
{
    protected $casts = [
        'applied_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    /**
     * Get the user who applied
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the job that was applied for
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
