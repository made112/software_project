<?php

namespace App\Notifications;

use App\Models\Versions;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProductVersionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $version;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Versions $versions)
    {
        $this->version = $versions;
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
            ->subject(__('mail.new_product_version_title'))
            ->view('email.new_version', ['version' => $this->version, 'reciever' => $notifiable]);
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
            'version' => $this->version, 'reciever' => $notifiable
        ];
    }
}
