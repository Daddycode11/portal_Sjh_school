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
        Schema::table('class_assignments', function (Blueprint $table) {
        /**
         *  'faculty_id',
        'section_id',
        'subject_id',
        'school_year',
        'semester'
         */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class_assignments', function (Blueprint $table) {
            //
        });
    }
};
