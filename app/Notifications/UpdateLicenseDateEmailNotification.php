<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateLicenseDateEmailNotification extends Notification implements ShouldQueue
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
            ->subject(__('mail.update_license_date_title'))
            ->view('email.update_license_date', ['license' => $this->license, 'user' => $notifiable,'flag'=>1]);
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
            "user" => $notifiable,
            'license' => $this->license
        ];
    }
}
