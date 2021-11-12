<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCLItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_l_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id'); //contact id
            $table->uuid('case_id'); //contact id
            $table->uuid('chech_list_id'); //check list id ?

            $table->string('subject');
            $table->string('cli_item_no');
            $table->integer('catagory_id');//->references('id')->on('categories');//->onDelete('cascade');
            $table->string('required_to')->nullable();
            $table->string('required_by')->nullable();
            $table->string('comments')->nullable();
            $table->string('help_link')->nullable();
            $table->string('status')->nullable();
            $table->string('cli_file')->nullable();
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
        Schema::dropIfExists('c_l_items');
    }
}
