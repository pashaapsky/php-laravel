<?php

namespace App\Observers;

use App\News;
use Illuminate\Support\Facades\Cache;

class NewsObserver
{
    /**
     * Handle the news "created" event.
     *
     * @param  \App\News  $news
     * @return void
     */
    public function created(News $news)
    {
        Cache::tags(['news', 'latest_news', 'statistics_data', 'tags_cloud'])->flush();
    }

    /**
     * Handle the news "updated" event.
     *
     * @param  \App\News  $news
     * @return void
     */
    public function updated(News $news)
    {
        Cache::tags(['news', 'latest_news', 'statistics_data', 'tags_cloud'])->flush();
    }

    /**
     * Handle the news "deleted" event.
     *
     * @param  \App\News  $news
     * @return void
     */
    public function deleted(News $news)
    {
        Cache::tags(['news', 'latest_news', 'statistics_data', 'tags_cloud'])->flush();
    }
}
