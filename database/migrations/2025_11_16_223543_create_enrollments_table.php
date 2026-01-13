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
        $table->string('student_name')->nullable();
        $table->string('grade_level')->nullable();
        $table->string('strand')->nullable();
        $table->string('section')->nullable();
        $table->string('contact_number')->nullable();
        $table->string('email')->nullable();
        $table->string('status')->default('Pending')->nullable();
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
