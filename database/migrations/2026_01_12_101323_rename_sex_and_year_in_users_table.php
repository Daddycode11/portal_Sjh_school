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
    Schema::table('users', function (Blueprint $table) {
        $table->renameColumn('sex', 'gender');
        $table->renameColumn('year', 'grade_level');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->renameColumn('gender', 'sex');
        $table->renameColumn('grade_level', 'year');
    });
}

};
