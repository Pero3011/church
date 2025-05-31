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
            $table->integer('confession1')->nullable();
            $table->integer('confession2')->nullable();
            $table->integer('confession3')->nullable();
            $table->integer('attendance1')->nullable();
            $table->integer('attendance2')->nullable();
            $table->integer('attendance3')->nullable();
            $table->integer('total_grade')->nullable();
            // Add more subjects as needed
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('subject1')->nullable();
            $table->integer('subject2')->nullable();
            $table->integer('subject3')->nullable();
            $table->boolean('grade_condition')->nullable();
            // Add more subjects as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['confession1', 'confession2', 'confession3','attendance1', 'attendance2', 'attendance3',  'total_grade']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['subject1', 'subject2', 'subject3', 'grade_condition']);
        });
    }
};
