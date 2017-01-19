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

        Schema::create('rooms', function(Blueprint $table){
            $table->increments('id');
            $table->string('name')->unique();
        });

        Schema::create('desks', function(Blueprint $table){
            $table->increments('id');
            $table->string('name')->unique();

            $table->unsignedInteger('room_id');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('CASCADE');
        });

        Schema::create('groups', function(Blueprint $table){
            $table->increments('id');

            $table->string("name")->unique();

            $table->unsignedInteger('desk_id');
            $table->foreign('desk_id')->references('id')->on('desks')->onDelete('CASCADE');
        });

        Schema::create('users', function(Blueprint $table){
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('password');
            $table->string('facepattern');
            $table->string('email');
            $table->string('type');

            $table->unsignedInteger('desk_id')->nullable();
            $table->foreign('desk_id')->references('id')->on('desks')->onDelete('SET NULL');
        });

        Schema::create('lamps', function(Blueprint $table){
            $table->increments('id');

            $table->string("name")->unique();
            $table->string("state");
            $table->double("x");
            $table->double("y");
            $table->string("color");
            $table->string("endpoint")->unique();
            $table->boolean("low_light");

            $table->unsignedInteger('group_id')->nullable();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('SET NULL');

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
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

            $table->string("name")->unique();

            $table->double("x");
            $table->double("y");
            $table->string("endpoint")->unique();

            $table->unsignedInteger('group_id')->nullable();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('SET NULL');

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
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
