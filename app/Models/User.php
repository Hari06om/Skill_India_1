<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'email', 'password', 'user_type', 'phone', 'company_name', 'bio', 'location', 'is_verified'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean',
        ];
    }

    /**
     * Get the jobs posted by this user (for employers)
     */
    public function jobsPosted()
    {
        return $this->hasMany(Job::class, 'posted_by');
    }

    /**
     * Get the job applications by this user (for job seekers)
     */
    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    /**
     * Get the professional profile of this user
     */
    public function professional()
    {
        return $this->hasOne(Professional::class);
    }

    /**
     * Get all trainer appointments booked by this user
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
