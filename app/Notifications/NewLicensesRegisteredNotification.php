<?php

namespace App\Notifications;

use App\Models\Clients;
use App\Models\License;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLicensesRegisteredNotification extends Notification
{
    use Queueable;

    /**
     * @var Clients
     */
    protected Clients $client;

    /**
     * @var License
     */
    protected License $license;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Clients $client, License $license)
    {
        $this->client = $client;
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject( __('mail.license_client_title') )
                    ->view('email.new_license', ['client' => $this->client, 'license' => $this->license]);
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
