<?php

namespace App\Events;

use App\News;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewsCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public News $news;

    /**
     * Create a new event instance.
     *
     * @param News $news
     */
    public function __construct(News $news)
    {
        $this->news = $news;
    }
}
