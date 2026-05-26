<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->string('job_type')->default('full-time'); // full-time, part-time, contract, freelance
            $table->string('salary_range')->nullable();
            $table->foreignId('posted_by')->constrained('users')->onDelete('cascade');
            $table->text('required_skills')->nullable();
            $table->string('experience_level')->default('entry'); // entry, mid, senior
            $table->integer('number_of_positions')->default(1);
            $table->date('application_deadline')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index('posted_by');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
