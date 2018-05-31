<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->tinyIncrements('id');
            $table->unsignedInteger('quiz_topic_id');
            $table->string('question', 256);
             $table->string('question_explanation')->nullable();
            $table->string('point');
            $table->unsignedInteger('user_id');
            $table->string('image')->nullable();
            $table->string('status')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('quiz_topic_id')->references('id')->on('quiz_topics');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
