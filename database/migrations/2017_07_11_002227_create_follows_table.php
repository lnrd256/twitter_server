<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_following_id')->unsigned();
            $table->integer('user_follower_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_following_id')
              ->references('id')->on('users')
              ->onDelete('cascade');
            $table->foreign('user_follower_id')
              ->references('id')->on('users')
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
        Schema::drop('follows');
    }
}
