<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');

            $table->enum('type', [1, 2])->default(1); // Free - Paid
            $table->enum('duration', [1, 2, 3])->default(1); // Days - Monthly - Anual

            $table->string('time')->nullable(); // If Duration [ monthly - Anual ]
            $table->string('duration_days')->nullable(); // If Duration [ Days ]
            $table->string('type_price');

            $table->string('support_type')->nullable();
            $table->string('support_price')->nullable();

            $table->string('prime_type')->nullable();
            $table->string('prime_price')->nullable();

            $table->enum('status', [1, 2])->default(1);


            $table->unsignedInteger('product_id');

            $table->foreign('product_id')->references('id')->on('products');

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
        Schema::dropIfExists('product_packages_test');
    }
}
