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
            $table->string('user_name')->unique();
            $table->string('prefered_name')->nullable();
            $table->string('name');
            $table->string('last_name');
            $table->string('nationalities');
            $table->string('avatar');//user image
            $table->string('password');

            //contact
            $table->string('phone_country_code')->nullable();
            $table->string('mobile_phone');
            $table->string('watsapp_no')->nullable();
            $table->string('email')->unique();
            $table->string('secondary_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('watsapp_update_option');
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('skipe')->nullable();
            $table->string('linkedin')->nullable();

            $table->string('lead_source');
            $table->string('refered_by')->nullable();
            $table->string('assigned_to'); //foreign id agent

            $table->string('qualified_for');
            $table->boolean('email_out_op');
            $table->string('lead_status_id');
            $table->string('lead_stage_id');

            $table->string('care_agent');
            $table->string('has_passport');
            $table->date('passport_expiration_date');
            $table->string('rating');
            $table->string('agent_id');
            $table->string('description');

            $table->timestamp('email_verified_at')->nullable();
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
