<?php

namespace App;

use App\Events\PostCreated;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => PostCreated::class,
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
