<?php

namespace App\Notifications;

use App\Models\Products;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewVersionToAdminNotification extends Notification
{
    use Queueable;

    /**
     * @var Setting;
     */
    protected Setting $admin;

    /**
     * @var Products
     */
    protected Products $product;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Setting $admin, Products $product)
    {
        $this->admin = $admin;
        $this->product = $product;
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
                    ->subject('New Version')
                    ->view('email.new_version_admin', ['user' => $this->admin, 'product' => $this->product]);
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