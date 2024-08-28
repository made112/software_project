<?php

namespace App\Notifications;

use App\Models\Products;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProductNotification extends Notification
{

    public $product;

    /**
     * @var User;
     */
    public User $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Products $products, User $user)
    {
        $this->product = $products;
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
            ->subject(__('mail.new_product_title'))
            ->view('email.new_product', ['user' => $this->user, 'product' => $this->product]);
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
            'reciever' => $notifiable, 'product' => $this->product
        ];
    }
}
