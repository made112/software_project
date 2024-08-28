<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications_sys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('notification_type');
            $table->datetime('date');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('user_id');
            $table->string('notification_title');
            $table->text('notification_content')->nullable();
            $table->tinyInteger('channel_id');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_send')->default(0);
            $table->datetime('send_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::create('notifications_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('notification_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('notification_id')->references('id')->on('notifications_sys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications_sys');
        Schema::dropIfExists('notifications_clients');
    }
}
