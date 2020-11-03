<?php

namespace App\Providers;

use App\News;
use App\Observers\NewsObserver;
use App\Observers\PostsObserver;
use App\Post;
use App\Services\StatisticService;
use App\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        view()->composer('layouts.aside-tags', function ($view) {
            $tags = Cache::tags('tags_cloud')->remember('tags_cloud', 3600, function () {
                return Tag::whereHas('posts')->orWhereHas('news')->get();
            });

            $view->with('tagsCloud', $tags);
        });

        $this->app->make(StatisticService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
