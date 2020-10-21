<?php

namespace App\Jobs;

use App\Comment;
use App\News;
use App\Post;
use App\Tag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Throwable;

class GenerateResultingOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $requestData;

    public function __construct($requestData)
    {
        $this->requestData = $requestData;
    }

    public function handle()
    {
        $data = [];

        if ($this->requestData) {
            if (array_key_exists ( 'news' , $this->requestData )) {
                $data['news'] = 'Новостей: ' . News::count() . PHP_EOL;
            }

            if (array_key_exists ( 'posts' , $this->requestData )) {
                $data['posts'] = 'Статей: ' . Post::count() . PHP_EOL;
            }

            if (array_key_exists ( 'comments' , $this->requestData )) {
                $data['comments'] = 'Комментариев: ' . Comment::count() . PHP_EOL;
            }

            if (array_key_exists ( 'tags' , $this->requestData )) {
                $data['tags'] = 'Тегов: ' . Tag::count() . PHP_EOL;
            }

            if (array_key_exists ( 'users' , $this->requestData )) {
                $data['users'] = 'Пользователей: ' . News::count() . PHP_EOL;
            }
        }

        Mail::to(auth()->user()->email)->send(
            new \App\Mail\ResultingOrderSend($data)
        );
    }

    public function failed(Throwable $exception)
    {
        // Send user notification of failure, etc...
    }
}
