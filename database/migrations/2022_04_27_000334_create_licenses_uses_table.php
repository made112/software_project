<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicensesUsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses_uses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('license_id');
            $table->tinyInteger('is_used')->default(0);
            $table->tinyInteger('is_activate')->default(0);
            $table->string('ip');
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
        Schema::dropIfExists('licenses_uses');
    }
}
