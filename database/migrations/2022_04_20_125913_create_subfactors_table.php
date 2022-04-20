<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubfactorsTable extends Migration
{

    public function up()
    {
        Schema::create('subfactors', function (Blueprint $table) {
            $table->id();
            $table->string('subfactor');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subfactors');
    }
}