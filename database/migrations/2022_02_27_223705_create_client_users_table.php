<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('job_title');
            $table->string('email');
            $table->string('phone_number');
            $table->string('mobile_prefix')->nullable();
            $table->string('mobile_country')->nullable();
            $table->boolean('status')->default(true);
            $table->string('photo')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->tinyInteger('gender');
            $table->unsignedInteger('country_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_users');
    }
}
