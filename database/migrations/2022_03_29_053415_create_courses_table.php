<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('courses');
        Schema::create('courses', function (Blueprint $table) {
            $table->integer('course_id')->autoIncrement();
            $table->string('teacher_id');
            $table->string('course_name');
            $table->string('course_type')->default('Lesson');
            $table->integer('min_speed')->nullable();
            $table->integer('max_error')->nullable();
            $table->integer('max_duration')->default(5);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
