<?php

namespace App;

use App\Events\PostCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $guarded = [];

//    protected $dispatchesEvents = [
//        'created' => PostCreated::class,
//    ];

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
}
