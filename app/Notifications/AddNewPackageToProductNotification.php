<?php

namespace App\Notifications;

use App\Models\ProductPackage;
use App\Models\Products;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddNewPackageToProductNotification extends Notification
{
    use Queueable;

    /**
     * @var Products
     */
    protected $product;

    /**
     * @var Setting;
     */
    protected $admin;


    /**
     * @var ProductPackage;
     */
    protected $package;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Products $product, Setting $admin, ProductPackage $package)
    {
        $this->product = $product;
        $this->admin = $admin;
        $this->package = $package;
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
            ->subject('mail.new_version')
            ->view('email.new_pacakge', ['user' => $this->admin, 'product' => $this->product, 'package' => $this->package]);
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
