<?php

namespace App;

use App\Events\PostUpdated;
use App\Mail\PostCreated;
use App\Traits\CacheModelActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use CacheModelActions;

    protected $table = 'posts';
    protected $guarded = [];

    public static $cacheTags = ['posts', 'latest_published_posts', 'tags_cloud', 'statistics_data'];

    protected $dispatchesEvents = [
        'created' => PostCreated::class,
        'updated' => PostUpdated::class,
    ];

    public function tags()
    {
//        return $this->belongsToMany(Tag::class);
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }
}
