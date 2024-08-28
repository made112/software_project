<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('email');
            $table->enum('priority', [1, 2, 3, 4])->default(1);
            $table->enum('status', [1, 2, 3, 4, 5, 6])->default(1);
            $table->enum('type', [1, 2, 3, 4, 5])->default(1);
            $table->text('ip')->nullable();

            $table->unsignedInteger('client_id');
            $table->unsignedInteger('group_id');

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('group_id')->references('id')->on('groups');

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
        Schema::dropIfExists('tickets');
    }
}
