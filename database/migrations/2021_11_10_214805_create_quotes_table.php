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
            $table->uuid('invoice_id'); //invoice id
            $table->double('total');
            $table->string('quote_no');
            $table->string('subject');
            $table->string('quote_state');
            $table->string('subtotal');
            $table->integer('discount'); //%
            $table->double('discount_amount');
            $table->double('s_h_amount');
            $table->string('currency');
            $table->string('pte_tax_total');
            $table->string('tax');
            $table->string('professional_services');
            $table->string('government_fee_subtotals');
            $table->string('professional_fee_subtotals');
            $table->string('all_sub_total');
            $table->string('taxes');
            $table->string('client_response_quote');
            $table->string('number_of_payments');
            $table->string('review');
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
