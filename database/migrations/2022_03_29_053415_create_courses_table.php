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
            $table->string('min_speed_a')->default(0);
            $table->string('min_accuracy_a')->default(0);
            $table->string('min_speed_b')->default(0);
            $table->string('min_accuracy_b')->default(0);
            $table->string('min_speed_c')->default(0);
            $table->string('min_accuracy_c')->default(0);
            $table->integer('max_slowdown')->default(2);
            $table->float('max_duration')->default(5);
            $table->boolean('disable_backspace')->default(0);
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
