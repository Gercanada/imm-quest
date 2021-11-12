<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklists', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id'); //contact id
            $table->uuid('case_id'); //contact id
            $table->string('subject');
            $table->integer('check_list_no');
            $table->string('applicant_full_name');
            $table->string('related_to');
            $table->string('active_items');
            $table->string('pending_items');
            $table->string('completed_items');
            $table->string('check_list_type');
            $table->string('completed'); //%
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
        Schema::dropIfExists('checklists');
    }
}
