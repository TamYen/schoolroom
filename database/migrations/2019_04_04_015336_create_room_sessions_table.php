<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room');
            $table->integer('shift');
            $table->integer('creater');
            $table->integer('subscriber')->nullable();
            $table->integer('approver')->nullable();
            $table->date('date');
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('room_sessions');
    }
}
