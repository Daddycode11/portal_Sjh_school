<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // link to users table
            $table->string('profile_picture')->nullable();
            $table->string('lrn')->nullable()->unique();
            $table->string('student_id')->nullable()->unique();
            $table->string('grade_level')->nullable();
            $table->string('strand')->nullable();
            $table->string('section')->nullable();
            $table->enum('gender', ['Male','Female'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('age')->nullable();
            $table->string('address')->nullable();
            $table->string('contact_number')->nullable();
            // Parent/Guardian info
            $table->string('parent_name')->nullable();
            $table->string('relationship')->nullable();
            $table->string('parent_contact')->nullable();
            $table->string('parent_email')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
