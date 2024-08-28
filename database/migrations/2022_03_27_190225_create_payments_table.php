<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('package_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('license_id')->nullable();
            $table->unsignedInteger('support_duration')->nullable();
            $table->unsignedInteger('package_price_id')->nullable();
            $table->string('ip')->nullable();
            $table->string('redirect_url')->nullable();
            $table->string('domain')->nullable();
            $table->string('api_key')->nullable();
            $table->integer('duration')->nullable();
            $table->tinyInteger('support_type')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->float('price')->default(0);
            $table->text('validation_error')->nullable();
            $table->text('error')->nullable();
            $table->string('refrence_no')->nullable();
            $table->string('payment_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('product_id')->references('id')->on('products');
            // $table->foreign('package_id')->references('id')->on('product_packages');
            $table->foreign('license_id')->references('id')->on('licenses');
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
        Schema::dropIfExists('payments');
    }
}
