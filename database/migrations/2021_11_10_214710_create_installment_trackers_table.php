<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installment_trackers', function (Blueprint $table) {
            $table->id();
            $table->string('propsal');
            $table->string('invoice');
            $table->string('subject');
            $table->string('installment_tracker_no');
            $table->string('it_type');
            $table->string('amount');
            $table->string('schedule');
            $table->string('installment_number');
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
        Schema::dropIfExists('installment_trackers');
    }
}
