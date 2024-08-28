<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('license_code');
            $table->string('time_zone');
            $table->Integer('blacklist_domain_attempts');
            $table->Integer('blacklist_ip_attempts');
            $table->tinyInteger('activation_attempts')->default(0);
            $table->tinyInteger('download_attempts')->default(0);
            $table->tinyInteger('api_request_rate_limiting_methond')->default(1);
            $table->Integer('api_request_rate_limit')->nullable();
            $table->text('api_blacklisted_domain')->nullable();
            $table->text('api_blacklisted_ips')->nullable();
            $table->text('api_key')->nullable();
            $table->Integer('remain_days_license')->default(0);
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
        Schema::dropIfExists('setting');
    }
}
