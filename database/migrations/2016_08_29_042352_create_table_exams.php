<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableExams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('account_id')->unsigned()->nullable();
            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade');

            $table->string('full_name');
            $table->string('phone_number');
            $table->string('identity_card')->unique();
            $table->string('email');

            $table->integer('university_id')->unsigned()->nullable();
            $table->foreign('university_id')
                ->references('id')
                ->on('university')
                ->onDelete('cascade');

            $table->integer('score');

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
        Schema::drop('exams');
    }
}
