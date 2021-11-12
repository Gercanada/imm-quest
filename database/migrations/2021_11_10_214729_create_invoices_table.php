<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id'); //contact id
            $table->uuid('case_id'); //case id
            $table->string('quote');
            $table->string('subtotal');
            $table->string('subject');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->integer('discount_percent');
            $table->double('discount_amount');
            $table->string('status');
            $table->string('currency');
            $table->string('invoice_no');
            $table->string('pre_tax_total');
            $table->string('received');
            $table->string('balalce');
            $table->string('payment_received');
            $table->string('invoice_balance');
            $table->string('tax');
            $table->string('government_fees');
            $table->string('professional_services');
            $table->string('type');
            $table->string('number_of_payments');
            $table->string('taxes');
            $table->string('gob_fees_due');
            $table->string('prof_serv_due');
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
        Schema::dropIfExists('invoices');
    }
}
