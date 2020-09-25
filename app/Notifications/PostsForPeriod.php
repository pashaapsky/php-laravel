<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostsForPeriod extends Notification
{
    use Queueable;

    public $posts;

    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('mail.posts-for-period', ['posts' => $this->posts]);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
