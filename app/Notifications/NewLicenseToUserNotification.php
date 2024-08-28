<?php

namespace App\Notifications;

use App\Models\Clients;
use App\Models\ClientUser;
use App\Models\License;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLicenseToUserNotification extends Notification
{
    use Queueable;

    /**
     * @var Clients
     */
    public Clients $client;

    /**
     * @var License
     */
    protected License $license;

    /**
     * @var ClientUser
     */
    protected ClientUser $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Clients $client, License $license, ClientUser $user)
    {
        $this->client = $client;
        $this->license = $license;
        $this->user = $user;
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
                    ->subject( __('mail.license_manager_title'))
                    ->view('email.new_license_to_user', ['client' => $this->client, 'license' => $this->license, 'user' => $this->user]);
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
