<?php

namespace App\Notifications;

use App\Models\Clients;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewClientNotification extends Notification
{
    use Queueable;

    /**
     * @var \App\Models\Clients;
     */
    protected $client;

    /**
     * @var \App\Models\Setting;
     */
    protected $setting;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Clients $client, Setting $setting)
    {
        $this->client = $client;
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
        return ['mail', 'database'];
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
            ->subject(__('mail.welcome_to_cyberx'))
            ->view('email.new_client', ['client' => $notifiable]);
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
            'client' => $notifiable
        ];
    }
}
