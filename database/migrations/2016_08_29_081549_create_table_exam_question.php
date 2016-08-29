<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableExamQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('exams_questions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('exam_id')->unsigned();
            $table->foreign('exam_id')
                ->references('id')
                ->on('exams')
                ->onDelete('cascade');

            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')
                ->references('id')
                ->on('questions')
                ->onDelete('cascade');

            $table->integer('true_answer_id')->unsigned()->nullable();
            $table->foreign('true_answer_id')
                ->references('id')
                ->on('answers')
                ->onDelete('cascade');

            $table->string('answer');

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
        //
        Schema::drop('exams_questions');
    }
}
