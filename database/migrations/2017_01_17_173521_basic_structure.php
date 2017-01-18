<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BasicStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Begin
        Schema::drop('users');

        Schema::create('users', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('password');
            $table->string('type');
        });


        Schema::create('rooms', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('groups', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('room_id');

            $table->foreign('room_id')->references('id')->on('rooms');
        });

        Schema::create('lamps', function(Blueprint $table){
            $table->increments('id');

            $table->unsignedInteger("x");
            $table->unsignedInteger("y");
            $table->string("color");

            $table->unsignedInteger('group_id');
            $table->foreign('group_id')->references('id')->on('groups');
        });

        Schema::create('priorities', function(Blueprint $table){
            $table->increments('id');

            $table->unsignedInteger("index");
            $table->unsignedInteger("user_location_x");
            $table->unsignedInteger("user_location_y");
            $table->boolean("low_light");

            $table->string("light_color");

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('lamp_id');
            $table->foreign('lamp_id')->references('id')->on('lamps');
        });

        Schema::create('sensors', function(Blueprint $table){
            $table->increments('id');

            $table->unsignedInteger("x");
            $table->unsignedInteger("y");

            $table->unsignedInteger('group_id');
            $table->foreign('group_id')->references('id')->on('groups');

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
