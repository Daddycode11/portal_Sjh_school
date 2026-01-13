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
        Schema::table('enrollments', function (Blueprint $table) {
            // $table->unsignedBigInteger('subject_id')->nullable()->after('student_id');
            // $table->unsignedBigInteger('section_id')->nullable()->after('subject_id'); 
            // $table->unsignedBigInteger('faculty_id')->nullable()->after('section_id'); 
            $table->string('email')->nullable()->after('faculty_id'); 
            $table->string('section')->nullable()->after('email'); 
            $table->string('strand')->nullable()->after('section'); 
            $table->string('grade_level')->nullable()->after('strand'); 
            $table->string('contact_number')->nullable()->after('grade_level'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn([ 'email', 'section', 'strand', 'grade_level', 'contact_number']);
        });
    }
};
