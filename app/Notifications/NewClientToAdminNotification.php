<?php

namespace App\Notifications;

use App\Models\Clients;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewClientToAdminNotification extends Notification
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
                    ->subject( __('mail.new_client_admin_title') )
                    ->view('email.new_client_to_admin', ['client' => $this->client, 'setting' => $this->setting]);
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
