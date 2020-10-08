<?php

namespace App\Providers;

use App\News;
use App\Post;
use App\Tag;
use App\Taggable;
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
            $postsAndNewsUniqueTagsID = Taggable::where('taggable_type', News::class)
                ->orWhere('taggable_type', Post::class)
                ->get()
                ->unique('tag_id')
                ->keyBy('tag_id')
                ->keys()
                ->sort()
            ;

            $tags = Tag::all()->whereIn('id', $postsAndNewsUniqueTagsID);

            $view->with('tagsCloud', $tags);
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
