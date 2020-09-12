<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPostCreateNotification
{
    /**
     * Handle the event.
     *
     * @param PostCreated $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        Mail::to($event->post->owner->email)->send(
            new \App\Mail\PostCreated($event->post)
        );
    }
}
