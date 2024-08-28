<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaticpageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_page', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('details');
            $table->string('slug');
            $table->string('photo')->nullable();
            $table->Integer('user_id');
            $table->tinyInteger('status');
            $table->tinyInteger('flag')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('static_page');
    }
}
