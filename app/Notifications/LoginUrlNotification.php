<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginUrlNotification extends Notification
{
    use Queueable;

    protected $otp;
    protected $expiresAt;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Login OTP')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your OTP for login is: **' . $this->otp . '**')
            ->line('This OTP will expire in **10 minutes**.')
            ->line('If you did not request this, please ignore this email.')
            ->line('Thank you for using our platform.');
    }
}
