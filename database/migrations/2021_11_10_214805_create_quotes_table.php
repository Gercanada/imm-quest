<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id'); //contact id
            $table->uuid('invoice_id')->nullable(); //invoice id
            $table->double('total');
            $table->string('quote_no');
            $table->string('subject');
            $table->string('quote_state')->nullable();
            $table->string('subtotal');
            $table->integer('discount'); //%
            $table->double('discount_amount')->nullable();
            $table->double('s_h_amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('pte_tax_total')->nullable();
            $table->string('tax')->nullable();
            $table->string('professional_services')->nullable();
            $table->string('government_fee_subtotals')->nullable();
            $table->string('professional_fee_subtotals')->nullable();
            $table->string('all_sub_total')->nullable();
            $table->string('taxes')->nullable();
            $table->string('client_response_quote')->nullable();
            $table->string('number_of_payments')->nullable();
            $table->string('review')->nullable();
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
        Schema::dropIfExists('quotes');
    }
}
