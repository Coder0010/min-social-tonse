<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id', 11)->key()->unsigned(false);
            $table->text('body');
            $table->integer('receiver_id');
            $table->integer('sender_id');
            $table->boolean('is_readed')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sender_id', 'message_sender_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('receiver_id', 'message_receiver_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
