<?php

namespace App\Notifications;

use App\Models\Clients;
use App\Models\License;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLicenseToManagerNotification extends Notification
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
     * @var User
     */
    protected User $project_manager;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Clients $client,License $license, User $project_manager)
    {
        $this->client = $client;
        $this->license = $license;
        $this->project_manager = $project_manager;
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
                    ->subject( __('mail.license_manager_title') )
                    ->view('email.new_license_to_manager', ['client' => $this->client, 'license' => $this->license, 'project_manager' => $this->project_manager]);
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