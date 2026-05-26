<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Professional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed a Job Seeker User
        $seeker = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'job_seeker',
            'phone' => '+91 9876543210',
            'location' => 'Mumbai',
            'bio' => 'Passionate web developer specializing in PHP, Laravel, and frontend UI design.',
        ]);

        // Seed seeker professional profile details
        Professional::create([
            'user_id' => $seeker->id,
            'bio' => 'Passionate web developer specializing in PHP, Laravel, and frontend UI design.',
            'experience_years' => 2,
            'location' => 'Mumbai',
            'skills' => ['PHP', 'Laravel', 'JavaScript', 'HTML5', 'Tailwind CSS'],
            'headline' => 'Junior Laravel Developer',
            'current_title' => 'Web Developer',
            'portfolio_url' => 'https://example.com/portfolio',
            'linkedin_url' => 'https://linkedin.com/in/testuser',
            'github_url' => 'https://github.com/testuser',
            'availability_status' => 'available',
            'notice_period' => 15,
        ]);

        // 2. Seed an Employer User
        $employer = User::create([
            'name' => 'Aria Tech Solutions',
            'email' => 'employer@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'employer',
            'phone' => '+91 8765432109',
            'company_name' => 'Aria Tech Solutions',
            'location' => 'Bangalore',
            'bio' => 'Next-generation tech hub building scalable web and cloud products.',
            'is_verified' => true,
        ]);

        // 3. Seed Trainer Profiles
        $this->call([
            TrainerSeeder::class,
        ]);

        // 4. Seed Jobs Posted by Employer
        $job1 = Job::create([
            'title' => 'Laravel Backend Developer',
            'description' => 'We are looking for a Laravel Backend Developer to join our core product team. You will write clean, testable PHP code, design database schemas, and build secure APIs. Familiarity with Eloquent relationships and REST APIs is required.',
            'location' => 'Bangalore',
            'job_type' => 'full-time',
            'salary_range' => '₹6,00,000 - ₹9,00,000',
            'posted_by' => $employer->id,
            'required_skills' => ['PHP', 'Laravel', 'MySQL', 'Git'],
            'experience_level' => 'entry',
            'number_of_positions' => 2,
            'application_deadline' => now()->addDays(30)->toDateString(),
            'is_active' => true,
        ]);

        $job2 = Job::create([
            'title' => 'AWS Cloud Architect',
            'description' => 'Lead the migration, deployment, and optimization of cloud services on AWS. Designing secure cloud topologies, configuring VPCs, IAM roles, and automated pipelines.',
            'location' => 'Remote',
            'job_type' => 'full-time',
            'salary_range' => '₹18,00,000 - ₹25,00,000',
            'posted_by' => $employer->id,
            'required_skills' => ['AWS', 'Terraform', 'Docker', 'Kubernetes'],
            'experience_level' => 'senior',
            'number_of_positions' => 1,
            'application_deadline' => now()->addDays(15)->toDateString(),
            'is_active' => true,
        ]);

        $job3 = Job::create([
            'title' => 'Frontend UI Engineer (React)',
            'description' => 'Build highly interactive, beautiful user interfaces using React, Tailwind CSS, and Vite. You will work closely with design teams to construct premium, animations-heavy dashboards.',
            'location' => 'Pune',
            'job_type' => 'contract',
            'salary_range' => '₹8,00,000 - ₹12,00,000',
            'posted_by' => $employer->id,
            'required_skills' => ['React', 'JavaScript', 'Tailwind CSS', 'Vite'],
            'experience_level' => 'mid',
            'number_of_positions' => 3,
            'application_deadline' => now()->addDays(45)->toDateString(),
            'is_active' => true,
        ]);

        // 5. Seed a Sample Job Application
        JobApplication::create([
            'user_id' => $seeker->id,
            'job_id' => $job1->id,
            'status' => 'pending',
            'cover_letter' => 'I would love to apply for this backend position. I have been building apps with Laravel for 2 years and have experience working with REST APIs.',
            'applied_at' => now()->subDays(2),
        ]);
    }
}
