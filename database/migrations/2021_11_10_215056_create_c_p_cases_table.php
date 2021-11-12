<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCPCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_p_cases', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id'); //contact id

            $table->string('applications_created');
            $table->string('gob_main_application_no');
            $table->date('open_date');
            $table->string('no_of_applications');
            $table->string('subcategory');
            $table->string('type');
            $table->string('stream');
            $table->string('invoice'); //?invoice id
            $table->string('ticket_no');
            $table->string('status');
            $table->string('category'); //?category id
            $table->string('title');
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
        Schema::dropIfExists('c_p_cases');
    }
}
