<?php

use App\Models\Factor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFactorIdToSubfactorsTable extends Migration
{
    public function up()
    {
        Schema::table('subfactors', function (Blueprint $table) {
            /*  $factor  = new Factor();
            $factor->title = "default";
            $factor->id = 0;
            $factor->save();
 */
            $table->unsignedBigInteger('factor_id')/* ->default($factor->id) */;
            $table->foreign('factor_id')->references('id')->on('factors');
        });
    }

    public function down()
    {
        Schema::table('subfactors', function (Blueprint $table) {
            $table->dropIfExists(['factor_id']);
            $table->dropColumn(['factor_id']);
        });
    }
}