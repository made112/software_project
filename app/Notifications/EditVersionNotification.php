<?php

namespace App\Notifications;

use App\Models\Products;
use App\Models\User;
use App\Models\Versions;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EditVersionNotification extends Notification
{
    use Queueable;

    /**
     * @var \App\Models\Products
     */

    protected $product;

    /**
     * @var User
     */
    protected User $user;

    /**
     * @var Versions
     */
    protected Versions $version;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Products $product, User $user, Versions $version)
    {
        $this->product = $product;
        $this->user = $user;
        $this->version = $version;
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
            ->subject('Version Updated.')
            ->view('email.edit_version', ['user' => $this->user, 'product' => $this->product, 'version' => $this->version]);
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
