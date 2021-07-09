<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration
{
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->increments('id', 11)->key()->unsigned(false);
            $table->enum('status', [config('system.status')])->nullable();
            $table->integer('receiver_id');
            $table->integer('sender_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sender_id', 'friend_sender_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('receiver_id', 'friend_receiver_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('friends');
    }
}
