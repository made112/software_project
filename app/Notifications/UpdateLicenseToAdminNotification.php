<?php

namespace App\Notifications;

use App\Models\Clients;
use App\Models\License;
use App\Models\Products;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateLicenseToAdminNotification extends Notification
{
    use Queueable;

    /**
     * @var License;
     */
    protected License $license;

    /**
     * @var Clients
     */
    protected Clients $client;

    /**
     * @var Products
     */
    protected Products $product;

    /**
     * @var Setting
     */
    protected Setting $setting;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(License $license, Clients $client, Products $product, Setting $setting)
    {
        $this->license = $license;
        $this->client = $client;
        $this->product = $product;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject( __('mail.update_license_title') )
                    ->view('email.update_license_admin', ['license' => $this->license, 'setting' => $this->setting, 'client' => $this->client, 'product' => $this->product]);
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
