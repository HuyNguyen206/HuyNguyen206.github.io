<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmailResetPass extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $data;
    public function __construct($data)
    {
        //
        $this->data = $data;
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
//        return (new MailMessage)
//                    ->subject('Notification Password Reset')
//                    ->greeting('Hi '.$this->data['name'])
//                    ->line("We've received a request to reset your password. If you didn't make the request
//                                , just ignore this email. Otherwise, you can reset your password using this link")
//                    ->action('Reset my password', $this->data['reset-link'])
//                    ->line('Thank you for using our application!');
        return (new MailMessage)
            ->subject('Notification Password Reset')
            ->markdown('mail.reset-pass', ['name' => $this->data['name'],'resetLink' =>  $this->data['reset-link']]);

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
