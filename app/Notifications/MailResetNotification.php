<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\ResetPassword;

class MailResetNotification extends ResetPassword
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        parent::__construct($token);
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
        $link = url( "https://the-skills.id/auth/reset-password/change-password?token=".$this->token );
        return ( new MailMessage )
            ->subject( 'Notifikasi Reset Password' )
            ->line( "Halo! Kamu menerima email ini karena akun theskills anda meminta untuk pergantian password." )
            ->action( 'Reset Password', $link )
            ->line( "Link ini akan kadaluwarsa dalam ".config('auth.passwords.users.expire')." menit" )
            ->line( "Jika kamu tidak merasa atas permintaan pergantian password, abaikan saja email ini." );
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
