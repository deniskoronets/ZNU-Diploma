<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitApp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('faculty_id');
            $table->integer('group_id');
            $table->integer('lesson_type_id');
            $table->integer('discipline_id');
            $table->integer('weekday');
            $table->boolean('is_numerator');
            $table->string('time_start', '5');
            $table->integer('year');
            $table->integer('semester');
        });

        Schema::create('dated_lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('faculty_id');
            $table->integer('group_id');
            $table->integer('lesson_type_id');
            $table->integer('discipline_id');
            $table->integer('year');
            $table->integer('semester');
            $table->datetime('date_of');
        });

        Schema::create('disciplines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('faculties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('specialities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('faculty_id');
            $table->string('name');
        });

        Schema::create('faculty_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('faculty_id');
            $table->integer('specialiy_id');
            $table->string('name');
        });

        Schema::create('date_holidays', function (Blueprint $table) {
            $table->date('date_at');
            $table->primary(['date_at']);
        });

        Schema::create('study_loads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('lesson_id');
            $table->boolean('is_dated');
            $table->integer('hours_num');
        });

        Schema::create('passes_study_loads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('lesson_id');
            $table->boolean('is_dated');
            $table->date('date_at');
            $table->integer('hours_num');
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('lesson_types');
		Schema::drop('lessons');
		Schema::drop('dated_lessons');
		Schema::drop('disciplines');
		Schema::drop('faculties');
		Schema::drop('specialities');
		Schema::drop('faculty_groups');
		Schema::drop('date_holidays');
		Schema::drop('study_loads');
		Schema::drop('passes_study_loads');
		Schema::drop('departments');
    }
}
