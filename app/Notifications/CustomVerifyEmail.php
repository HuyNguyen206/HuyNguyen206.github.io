<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;

class CustomVerifyEmail extends VerifyEmailBase
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $data;
    public function __construct()
    {
        //
        $this->data = \Auth::user();
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
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        return (new MailMessage)
            ->subject('Verify Email Address')
            ->markdown('mail.verify-mail', ['name' => $this->data->name,'verifyLink' =>  $this->verificationUrl($notifiable)]);
//        return (new MailMessage)
//            ->subject(Lang::getFromJson('Verify Email Address'))
//            ->line(Lang::getFromJson('Please click the button below to verify your email address.'))
//            ->action(
//                Lang::getFromJson('Verify Email Address'),
//                $this->verificationUrl($notifiable)
//            )
//            ->line(Lang::getFromJson('If you did not create an account, no further action is required.'));


//        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');
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
