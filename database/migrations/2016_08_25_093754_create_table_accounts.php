<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid');
            $table->string('username')->unique();
            $table->string('email');
            $table->string('client_ip');
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('identity_card');
            $table->dateTime('date_of_birth');
            $table->string('address');

            $table->integer('university_id')->unsigned()->nullable();
            $table->foreign('university_id')
                ->references('id')
                ->on('university')
                ->onDelete('cascade');

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
        Schema::drop('accounts');
    }
}
