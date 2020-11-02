<?php

namespace App;

use App\Events\NewsCreated;
use App\Events\NewsDeleted;
use App\Events\NewsUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => NewsCreated::class,
        'updated' => NewsUpdated::class,
        'deleted' => NewsDeleted::class
    ];

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
