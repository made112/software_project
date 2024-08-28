<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColJobidNotificationsSys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications_sys', function (Blueprint $table) {
            $table->unsignedInteger('job_id')->nullable();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications_sys', function (Blueprint $table) {
            $table->dropColumn('job_id');
        });
    }
}
