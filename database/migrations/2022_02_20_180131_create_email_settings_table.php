<?php

use App\Models\EmailSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('email_method')->default(EmailSetting::EMAIL_METHODS[0]['id']);
            $table->string('from_email');
            $table->string('license_expiring_email_title');
            $table->string('support_ending_email_title');
            $table->longText('license_expiring_email_template');
            $table->longText('support_ending_email_template');
            $table->boolean('license_expired_notification');
            $table->boolean('support_end_email_notification');

            $table->string('update_license_expiring_email_title');
            $table->string('update_support_ending_email_title');
            $table->longText('update_license_expiring_email_template');
            $table->longText('update_support_ending_email_template');
            $table->boolean('update_license_expired_notification');
            $table->boolean('update_support_end_email_notification');

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
        Schema::dropIfExists('email_settings');
    }
}
