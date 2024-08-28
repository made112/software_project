<?php

namespace App\Notifications;

use App\Models\Clients;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateCompanyToManagerNotification extends Notification
{
    use Queueable;

    /**
     * @var Clients
     */
    protected Clients $client;

    /**
     * @var User
     */
    protected User $project_manager;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Clients $client, User $project_manager)
    {
        $this->client = $client;
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
                    ->subject( __('mail.company_update') )
                    ->view('email.update_company_manager', ['client' => $this->client, 'project_manager' => $this->project_manager]);
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
