<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('enrollments', function (Blueprint $table) {

        if (!Schema::hasColumn('enrollments', 'strand')) {
            $table->string('strand')->nullable();
        }

        if (!Schema::hasColumn('enrollments', 'section')) {
            $table->string('section')->nullable();
        }

        if (!Schema::hasColumn('enrollments', 'contact_number')) {
            $table->string('contact_number')->nullable();
        }

        if (!Schema::hasColumn('enrollments', 'email')) {
            $table->string('email')->nullable();
        }

    });
}

public function down()
{
    Schema::table('enrollments', function (Blueprint $table) {
        $table->dropColumn(['strand', 'section', 'contact_number', 'email']);
    });
}
};

