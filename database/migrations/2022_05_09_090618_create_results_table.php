<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id('result_id')->autoIncrement();
            $table->integer('user_id');
            $table->integer('lesson_id');
            $table->string('total_words');
            $table->string('minutes');
            $table->string('correct_words');
            $table->string('incorrect_words');
            $table->string('wpm');
            $table->string('accuracy');
            $table->string('overall_rating');
            $table->string('type');
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
        Schema::dropIfExists('results');
    }
}
