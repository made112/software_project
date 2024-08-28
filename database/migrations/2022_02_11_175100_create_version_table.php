<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('date');
            $table->unsignedInteger('product_id');
            $table->string('notification_summry');
            $table->text('change_log')->nullable();
            $table->string('main_files')->nullable();
            $table->string('sql_files')->nullable();
            $table->unsignedInteger('user_id');
            $table->Integer('downloads')->default(0);
            $table->tinyInteger('publish_version')->default(0);
            $table->tinyInteger('block')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('version');
    }
}
