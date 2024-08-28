<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class EmailSetting extends Model
{
    use HasFactory;
    use LogsActivity;

    protected static $logAttributes = ['*'];

    /**
     * define email methods variable
     */
    const EMAIL_METHODS = [
        [
            'id' => 1,
            'name' => "PHP MAIL"
        ]
    ];

    /**
     * @var mixed casts
     */
    protected $casts = [
        'update_support_end_email_notification' => 'boolean',
        'update_license_expired_notification' => 'boolean',
        'support_end_email_notification' => 'boolean',
        'license_expired_notification' => 'boolean',
    ];

    /**
     * @var mixed fillable
     */
    protected $fillable = [
        'email_method',
        "from_email",
        "license_expiring_email_title",
        "support_ending_email_title",
        "license_expiring_email_template",
        "support_ending_email_template",
        "license_expired_notification",
        "support_end_email_notification",
        "update_license_expiring_email_title",
        "update_support_ending_email_title",
        "update_license_expiring_email_template",
        "update_support_ending_email_template",
        "update_license_expired_notification",
        "update_support_end_email_notification",
    ];


    /**
     * @var MAIL_TEMPLATE_VARIABLES
     */
    const MAIL_TEMPLATE_VARIABLES = [
        'client_name' => '{{client}}',
        'product_name' => '{{product}}',
    ];

    /**
     * override log description message
     *
     * @param string $eventName
     * @return string
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        return " has {$eventName} email settings ";
    }
}
