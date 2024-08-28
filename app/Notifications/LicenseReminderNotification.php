<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LicenseReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $license;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($license)
    {
        $this->license = $license;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
            ->subject(__('lang.license_expiration_date'))
            ->view('email.one_third_license_time', ['client' => $notifiable, 'license' => $this->license]);
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
            'client' => $notifiable, 'licenses' => $this->license
        ];
    }
}
