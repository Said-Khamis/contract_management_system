<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class MailResetPasswordToken extends Notification
{
    use Queueable;

    private $token;
    private $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($token,User $user){
        $this->token = $token;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Reset Password Request")
            ->view("emails.reset-password", [
                'reset_url' => route(
                    'password.reset', [
                        'token' => $this->token,
                        'email' => $notifiable->email
                    ]
                ),
                'expire_msg' => Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]),
                'first_name' => $this->user->first_name,
                'last_name' => $this->user->last_name,

            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'to' => $notifiable->email,
            'subject' => 'Reset Password Request',
            'body' => view('emails.reset-password', [
                    'token' => $this->token,
                    'email' => $notifiable->email
                ]
            ),
        ];
    }
}
