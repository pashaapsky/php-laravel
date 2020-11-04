<?php

namespace App;

use App\Traits\CacheModelActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    use CacheModelActions;

    protected $table = 'tags';
    public static $cacheTags = ['posts', 'news', 'tags_cloud'];

    protected $guarded = [];

    public function posts()
    {
//        return $this->belongsToMany(Post::class);
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function news()
    {
//        return $this->belongsToMany(News::class, 'new_tag', 'tag_id', 'new_id');
        return $this->morphedByMany(News::class, 'taggable');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
