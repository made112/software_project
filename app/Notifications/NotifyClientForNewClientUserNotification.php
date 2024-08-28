<?php

namespace App\Notifications;

use App\Models\ClientUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyClientForNewClientUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $clientUser;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ClientUser $clientUser)
    {
        $this->clientUser = $clientUser;
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
            ->subject(__('mail.client_email_new_client_user'))
            ->view('email.client_new_client_user', ['client' => $notifiable, 'clientUser' => $this->clientUser]);
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
            'client' => $notifiable, 'clientUser' => $this->clientUser
        ];
    }
}
