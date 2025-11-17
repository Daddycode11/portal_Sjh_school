<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('enrollment_applications')) {
            Schema::create('enrollment_applications', function (Blueprint $table) {
                $table->id();
                $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('grade_level_id')->constrained('grade_levels');
                $table->foreignId('section_id')->nullable()->constrained('sections');
                $table->string('school_year')->nullable();
                $table->string('status')->default('pending');
                $table->timestamps();
            });
        } else {
            // Add missing columns if table exists
            Schema::table('enrollment_applications', function (Blueprint $table) {
                if (!Schema::hasColumn('enrollment_applications', 'section_id')) {
                    $table->foreignId('section_id')->nullable()->constrained('sections');
                }
                if (!Schema::hasColumn('enrollment_applications', 'school_year')) {
                    $table->string('school_year')->nullable();
                }
                if (!Schema::hasColumn('enrollment_applications', 'status')) {
                    $table->string('status')->default('pending');
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollment_applications');
    }
};
