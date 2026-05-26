<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'bio', 'experience_years', 'location', 'skills', 'headline', 'current_title', 'portfolio_url', 'linkedin_url', 'github_url', 'certifications', 'availability_status', 'notice_period'])]
class Professional extends Model
{
    protected $casts = [
        'skills' => 'array',
        'certifications' => 'array',
    ];

    /**
     * Get the user associated with this professional profile
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
