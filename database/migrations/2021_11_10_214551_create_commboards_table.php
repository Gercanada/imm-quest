<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commboards', function (Blueprint $table) {
            $table->id();
            //$table->uuid('user_id'); //contact id
            $table->string('name');
            $table->string('comm_board_no');
            $table->string('thread_id');
            $table->string('thread_type');
            $table->string('message_sender');
            $table->string('message_time');
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
        Schema::dropIfExists('commboards');
    }
}
