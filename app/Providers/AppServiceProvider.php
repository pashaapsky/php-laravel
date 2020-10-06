<?php

namespace App\Providers;

use App\NewTag;
use App\PostTag;
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
            $postsTags = PostTag::all()->unique('tag_id')->keyBy('tag_id');
            $newsTags = NewTag::all()->unique('tag_id')->keyBy('tag_id');
            $keys = $postsTags->mergeRecursive($newsTags)->keyBy('tag_id')->keys()->sort();

            $postsAndNewsTags = Tag::all()->whereIn('id', $keys);

            $view->with('tagsCloud', $postsAndNewsTags);
        });
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
