<?php

namespace App\Observers;

use App\Post;
use Illuminate\Support\Facades\Cache;

class PostsObserver
{
    /**
     * Handle the post "created" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        Cache::tags(['posts', 'latest_published_posts', 'statistics_data', 'tags_cloud'])->flush();
    }

    /**
     * Handle the post "updated" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        Cache::tags(['posts', 'latest_published_posts', 'tags_cloud'])->flush();
    }

    /**
     * Handle the post "deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        Cache::tags(['posts', 'latest_published_posts', 'tags_cloud'])->flush();
    }
}
