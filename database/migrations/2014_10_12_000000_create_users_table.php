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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('nationalities');
            $table->string('mobile_phone');
            $table->string('lead_source');
            $table->string('watsapp_no')->nullable();
            $table->string('refered_by')->nullable();
            $table->string('email')->unique();
            $table->string('assigned_to'); //foreign id agent

            $table->string('qualified_for');
            $table->string('secondary_email');
            $table->boolean('email_out_op');
            $table->string('lead_status_id');
            $table->string('lead_stage_id');

            $table->string('care_agent');
            $table->string('phone');
            $table->string('fax');
            $table->date('has_passport');
            $table->date('passport_expiration_date');
            $table->string('rating');
            $table->string('watsapp_update_option');
            $table->string('agent_id');
            $table->string('description');

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
