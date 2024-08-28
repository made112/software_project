<?php

namespace App\Notifications;

use App\Models\Clients;
use App\Models\License;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLicenseToAdminNotification extends Notification
{
    use Queueable;

    /**
     * @var Clients;
     */
    protected Clients $client;

    /**
     * @var Setting;
     */
    protected Setting $setting;

    /**
     * @var License
     */
    protected License $license;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Setting $setting, License $license, Clients $client)
    {
        $this->client = $client;
        $this->license = $license;
        $this->setting = $setting;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject( __('mail.license_admin_title') )
                    ->view('email.new_license_to_admin', ['client' => $this->client, 'license' => $this->license, 'setting' => $this->setting]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
