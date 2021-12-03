<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) { // users or contacts
            $table->id();
            //about
            $table->string('user_name')->unique()->nullable();

            $table->string('name')->nullable();
            $table->string('last_name')->nullable();

            $table->string('alternative_username')->unique()->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->text('description')->nullable();

            $table->string('vtiger_contact_id')->nullable()->unique();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('refresh_token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
