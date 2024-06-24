<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('パスワードリセットのリクエスト')
            ->line('パスワードリセットのリクエストを受け付けました。')
            ->action('パスワードリセット', $resetUrl)
            ->line('このリンクの有効期限は60分です。')
            ->line('もし心当たりがない場合は、このメールを無視してください。');
    }
}
