<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('enrollments', function (Blueprint $table) {
        $table->id();
        $table->string('student_name');
        $table->string('grade_level');
        $table->string('strand');
        $table->string('section')->nullable();
        $table->string('contact_number');
        $table->string('email');
        $table->string('status')->default('Pending');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
