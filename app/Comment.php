<?php

namespace App;

use App\Traits\CacheModelActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    use CacheModelActions;

    protected $table = 'comments';
    protected $guarded = [''];
    public static $cacheTags = 'comments';

    public function commentable()
    {
        return $this->morphTo();
    }
}
