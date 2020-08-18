<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountCreationNotification extends Notification
{
    use Queueable;
    protected $myData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($myData)
    {
        $this->mydata = $myData;
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
                    ->greeting('Hello,')
                    ->line('You are Receiving this because your email was used to create')
                    ->line('an account on '.config('app.name'))
                    ->line('Your password id: '. $this->mydata)
                    ->line('You can change your password in settings, or keep this for a strong account security!.')
                    ->line('Thank you for using ' . config('app.name').'!');
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
