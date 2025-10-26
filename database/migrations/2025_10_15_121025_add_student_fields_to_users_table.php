<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Basic Information
            $table->string('profile_picture')->nullable()->after('id');
            $table->string('lrn')->nullable()->unique()->after('name');
            $table->string('grade_level')->nullable()->after('course');
            $table->string('strand')->nullable()->after('grade_level');
            $table->string('section')->nullable()->after('strand');
            $table->enum('gender', ['Male', 'Female'])->nullable()->after('sex');
            $table->date('birth_date')->nullable()->after('gender');
            $table->integer('age')->nullable()->after('birth_date');
            $table->string('address')->nullable()->after('age');
            $table->string('contact_number')->nullable()->after('address');
            $table->string('email')->nullable()->unique()->change();

            // Parent/Guardian Information
            $table->string('parent_name')->nullable()->after('contact_number');
            $table->string('relationship')->nullable()->after('parent_name');
            $table->string('parent_contact')->nullable()->after('relationship');
            $table->string('parent_email')->nullable()->after('parent_contact');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'profile_picture', 'lrn', 'grade_level', 'strand', 'section', 'gender',
                'birth_date', 'age', 'address', 'contact_number',
                'parent_name', 'relationship', 'parent_contact', 'parent_email'
            ]);
        });
    }
};
