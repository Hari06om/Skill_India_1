<?php

namespace Database\Seeders;

use App\Models\Trainer;
use Illuminate\Database\Seeder;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trainers = [
            [
                'name' => 'Amit Mehta',
                'expert_skill' => 'Full Stack Development',
                'rating' => 4.9,
                'hourly_rate' => 600,
                'availability' => 'Mon-Fri, 10 AM - 6 PM',
                'bio' => 'Experienced full-stack developer with 12 years in web technologies. Specializes in modern frameworks and best practices.',
                'avatar_char' => 'AM',
            ],
            [
                'name' => 'Priya Nair',
                'expert_skill' => 'AWS Cloud Architecture',
                'rating' => 4.8,
                'hourly_rate' => 800,
                'availability' => 'Tue-Sat, 2 PM - 8 PM',
                'bio' => 'AWS Certified Solutions Architect with expertise in cloud infrastructure, scaling, and DevOps practices.',
                'avatar_char' => 'PN',
            ],
            [
                'name' => 'Ramesh Kumar',
                'expert_skill' => 'Welding & Metallurgical Engineering',
                'rating' => 4.7,
                'hourly_rate' => 400,
                'availability' => 'Mon-Fri, 9 AM - 5 PM',
                'bio' => 'Industrial trainer with 15 years of hands-on experience in welding techniques and metallurgy certification programs.',
                'avatar_char' => 'RK',
            ],
            [
                'name' => 'Sneha Patil',
                'expert_skill' => 'Soft Skills & Communication',
                'rating' => 4.9,
                'hourly_rate' => 350,
                'availability' => 'Mon-Sat, 11 AM - 7 PM',
                'bio' => 'Professional communications coach specializing in interview prep, presentation skills, and professional etiquette.',
                'avatar_char' => 'SP',
            ],
            [
                'name' => 'Vijay Sharma',
                'expert_skill' => 'AI & Machine Learning',
                'rating' => 5.0,
                'hourly_rate' => 1000,
                'availability' => 'Flexible Schedule',
                'bio' => 'PhD in Computer Science, AI researcher with publications in top conferences. Tutors ML algorithms and deep learning.',
                'avatar_char' => 'VS',
            ],
        ];

        foreach ($trainers as $trainer) {
            Trainer::create($trainer);
        }
    }
}
