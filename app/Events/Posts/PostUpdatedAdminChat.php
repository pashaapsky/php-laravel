<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostUpdatedAdminChat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post;
    public $data;

    public function __construct($post, $data)
    {
        $this->post = $post;
        $this->data = $data;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('admin-chat-channel');
    }
}
