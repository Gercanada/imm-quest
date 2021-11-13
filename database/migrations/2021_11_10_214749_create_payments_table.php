<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id'); //contact id
            $table->uuid('case_id'); //case id
            $table->uuid('invoice_id'); //invoice id ??
            $table->string('subject');
            $table->string('payments_no');
            $table->string('currency');
            $table->double('amount');
            $table->date('payment_date');
            $table->string('payment_method');
            $table->string('payment_type')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
