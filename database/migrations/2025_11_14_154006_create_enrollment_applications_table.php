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
       Schema::create('enrollments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('student_id')->constrained('users')->onDelete('cascade')->nullable();
    $table->foreignId('grade_level_id')->constrained('grade_levels')->nullable();
    $table->foreignId('section_id')->nullable()->constrained('sections');
    $table->string('school_year')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollment_applications');
    }
};
