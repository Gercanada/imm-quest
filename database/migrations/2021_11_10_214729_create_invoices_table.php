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
            $table->uuid('quote_id');
            $table->string('subtotal');
            $table->string('subject');
            $table->date('invoice_date')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('discount_percent')->nullable();
            $table->double('discount_amount')->nullable();
            $table->string('status')->nullable();
            $table->string('currency')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('pre_tax_total')->nullable();
            $table->string('received')->nullable();
            $table->string('balalce')->nullable();
            $table->string('payment_received')->nullable();
            $table->string('invoice_balance')->nullable();
            $table->string('tax')->nullable();
            $table->string('government_fees')->nullable();
            $table->string('professional_services')->nullable();
            $table->string('type')->nullable();
            $table->string('number_of_payments')->nullable();
            $table->string('taxes')->nullable();
            $table->string('gob_fees_due')->nullable();
            $table->string('prof_serv_due')->nullable();
            $table->boolean('paid')->default(false);
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
