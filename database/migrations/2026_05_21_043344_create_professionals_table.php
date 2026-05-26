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
        Schema::create('professionals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->text('bio')->nullable();
            $table->integer('experience_years')->default(0);
            $table->string('location')->nullable();
            $table->json('skills')->nullable();
            $table->string('headline')->nullable();
            $table->string('current_title')->nullable();
            $table->text('portfolio_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('github_url')->nullable();
            $table->json('certifications')->nullable();
            $table->string('availability_status')->default('available'); // available, not available
            $table->integer('notice_period')->nullable(); // in days
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionals');
    }
};
