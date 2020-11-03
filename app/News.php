<?php

namespace App;

use App\Traits\CacheModelActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    use CacheModelActions;

    protected $guarded = [];
    public static $cacheTags = ['news', 'latest_news', 'statistics_data', 'tags_cloud'];

    public function tags()
    {
//        return $this->belongsToMany(Tag::class, 'new_tag', 'new_id', 'tag_id');
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
