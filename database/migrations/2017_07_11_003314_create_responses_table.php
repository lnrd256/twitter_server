<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_tweet_id')->unsigned();
            $table->integer('destination_tweet_id')->unsigned();
            $table->integer('type_response');

            $table->timestamps();
            $table->foreign('sender_tweet_id')
              ->references('id')->on('tweets')
              ->onDelete('cascade');
            $table->foreign('destination_tweet_id')
              ->references('id')->on('tweets')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('responses');
    }
}
