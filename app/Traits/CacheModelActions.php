<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait CacheModelActions
{
    public static function bootCacheModelActions()
    {
        static::created(function()
        {
            Cache::tags(static::$cacheTags)->flush();
        });

        static::updated(function($item)
        {
            Cache::tags(static::$cacheTags)->flush();
        });

        static::deleted(function()
        {
            Cache::tags(static::$cacheTags)->flush();
        });
    }
}
