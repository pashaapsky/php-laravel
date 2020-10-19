<?php

namespace App\Providers;

use App\Services\StatisticService;
use App\Tag;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('layouts.aside-tags', function ($view) {
            $tags = Tag::whereHas('posts')->orWhereHas('news')->get();

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
