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
        Schema::create('enrollment_requests', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // student
        $table->string('grade_level');
        $table->unsignedBigInteger('section_id');
        $table->string('school_year')->nullable();
        $table->string('status')->default('pending'); // pending / approved / rejected
        $table->text('remarks')->nullable();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollment_requests');
    }
};
