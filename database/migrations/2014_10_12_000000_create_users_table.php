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
            $table->string('prefered_name')->nullable();
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('nationalities')->nullable();
            $table->string('avatar')->nullable();//user image
            $table->string('password')->nullable();

            //contact
            $table->string('phone_country_code')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('watsapp_no')->nullable();
            $table->string('email')->unique();
            $table->string('secondary_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('watsapp_update_option')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('skipe')->nullable();
            $table->string('linkedin')->nullable();

            $table->string('lead_source')->nullable();;
            $table->string('refered_by')->nullable();
            $table->string('assigned_to')->nullable(); //foreign id agent

            $table->string('qualified_for')->nullable();
            $table->boolean('email_out_op')->nullable();
            $table->string('lead_status_id')->nullable();
            $table->string('lead_stage_id')->nullable();

            $table->string('care_agent')->nullable();
            $table->string('has_passport')->nullable();
            $table->date('passport_expiration_date')->nullable();
            $table->string('rating')->nullable();
            $table->string('agent_id')->nullable();
            $table->string('description')->nullable();

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
