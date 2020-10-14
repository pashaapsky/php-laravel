<?php

namespace App\Services;

use App\News;
use App\Post;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class GetStatisticService
{
    /**
     * Количество постов на сайте
     * @return int
     */
    static public function getPostsCount()
    {
        return Post::all()->count();
    }

    /**
     * Общее количество новостей
     * @return int
     */
    static public function getNewsCount()
    {
        return News::all()->count();
    }


    /**
     * Пользователь с наибольшим количеством постов
     * @return User
     */
    static public function getUserWithMaxPosts()
    {
        $maxPosts = DB::table('posts')
            ->select(DB::raw('count(*) as post_count, owner_id'))
            ->groupBy('owner_id')
            ->orderBy('post_count', 'desc')
            ->take(1)
            ->get();

        $usersWithMaxPostsCount = \App\User::find($maxPosts[0]->owner_id);

        return $usersWithMaxPostsCount;
    }

    static public function getTheLongestPosts()
    {


        return;
    }



}
