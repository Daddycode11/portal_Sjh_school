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
        if (!Schema::hasColumn('enrollments', 'subject_id')) {
            $table->foreignId('subject_id')->constrained('subjects')->after('section_id')->nullable();
        }
    });
}


public function down()
{
    Schema::table('enrollments', function (Blueprint $table) {
        if (Schema::hasColumn('enrollments', 'subject_id')) {
            $table->dropForeign(['subject_id']); // drop FK first
            $table->dropColumn('subject_id');    // then drop the column
        }
    });
}


};
