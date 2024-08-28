<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ProductPackage;
use App\Models\Setting;

class NewPackageToAdminNotification extends Notification
{
    use Queueable;

    /**
     * @var \App\Models\Setting;
     */
    public $admin;

    /**
     * @var \App\Models\ProductPackage;
     */
    public $package;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Setting $admin, ProductPackage $package)
    {
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
                    ->subject( __('mail.new_package') )
                    ->view('email.new_pacakge_to_admin', ['user' => $this->admin, 'package' => $this->package]);
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
