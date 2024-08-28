<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGitlabToClientsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients_products', function (Blueprint $table) {
            $table->string('gitlab_link')->nullable();
            $table->string('gitlab_username')->nullable();
            $table->string('gitlab_access_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients_products', function (Blueprint $table) {
            //
        });
    }
}
