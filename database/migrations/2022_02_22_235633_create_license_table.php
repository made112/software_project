<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('product_id');
            $table->string('license_code')->unique();
            $table->unsignedInteger('use_limit')->nullable();
            $table->unsignedInteger('parallel_use_limit')->nullable();
            $table->tinyInteger('type');
            $table->tinyInteger('support_type');
            $table->tinyInteger('payment_type');
            $table->string('file')->nullable();
            $table->text('domains')->nullable();
            $table->text('ip')->nullable();
            $table->date('date')->nullable();
            $table->unsignedInteger('grace_end_days')->nullable();
            $table->unsignedInteger('days')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('machine_id')->nullable();
            $table->string('comments')->nullable();
            $table->text('hash_code')->nullable();
            $table->tinyInteger('block')->default(0);
            $table->Integer('uses_left')->default(0);
            $table->tinyInteger('usage')->default(0);
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('license');
    }
}
