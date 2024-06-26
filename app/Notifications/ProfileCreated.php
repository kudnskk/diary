<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProfileCreated extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
{
    return (new MailMessage)
                ->subject('Profile Created')
                ->greeting('Hello ' . $notifiable->name)
                ->line('Your profile has been successfully created.')
                ->line('Thank you for using our application!');
}
}
