<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToLicensesUsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('licenses_uses', function (Blueprint $table) {
            $table->string('uuid')->after('ip')->nullable();
            $table->text('public_key')->after('ip')->nullable();
            $table->string('os_type')->after('ip')->nullable();
            $table->string('mac_address')->after('ip')->nullable();
            $table->text('others')->after('ip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('licenses_uses', function (Blueprint $table) {
            $table->dropColumn(['uuid', 'public_key', 'os_type', 'mac_address', 'others']);
        });
    }
}
