<?php

use App\Models\Criterion;
use App\Models\Subfactor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubfactorIdToCriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('criteria', function (Blueprint $table) {
            $subFactor  = new Subfactor();
            $subFactor->subfactor = "default";
            $subFactor->save();

            $table->unsignedBigInteger('subfactor_id')->default($subFactor->id);
            $table->foreign('subfactor_id')->references('id')->on('subfactors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('criteria', function (Blueprint $table) {
            $table->dropIfExists(['subfactor_id']);
            $table->dropColumn(['subfactor_id']);
        });
    }
}