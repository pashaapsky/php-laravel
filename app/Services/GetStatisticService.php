<?php

namespace App\Services;

use App\News;
use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class GetStatisticService
{
    /**
     * Количество постов на сайте
     * @return int
     */
    static public function getPostsCount()
    {
        return Post::count();
    }

    /**
     * Общее количество новостей
     * @return int
     */
    static public function getNewsCount()
    {
        return News::count();
    }


    /**
     * @return Collection
     */

    static public function getUserWithMaxPosts()
    {
//        $users = User::has('posts')->withCount('posts')->get();
//        $usersWithMostPostsCount = $users->where('posts_count', $users->max('posts_count'));

        $users = DB::table('users')
            ->join('posts', 'users.id', '=', 'owner_id')
            ->select('users.name', DB::raw('Count(*) as posts_count'))
            ->groupBy('users.name')
            ->orderByDesc('posts_count')
            ->first();

        $usersWithMostPostsCount = User::find('name', $users->name);

        return $usersWithMostPostsCount;
    }


    /**
     * @return Collection
     */

    static public function getTheLongestPosts()
    {
        $theLongestPosts = Post::where(DB::raw('Length(text)'), function($query){
            $query->select(DB::raw('MAX(Length(text))'))
                ->from(DB::table('posts'));
        })->get();

        return $theLongestPosts;
    }

    /**
     * @return Collection
     */

    static public function getTheShortestPosts()
    {
        $theShortestPosts = Post::where(DB::raw('Length(text)'), function($query){
            $query->select(DB::raw('MIN(Length(text))'))
                ->from(DB::table('posts'));
        })->get();

        return $theShortestPosts;
    }

    /**
     * @return int
     */

    static public function getAveragePosts()
    {
        $posts = User::has('posts', '>', 1)->withCount('posts')->get();
        $averagePosts = intval(round($posts->avg('posts_count')));

        return $averagePosts;
    }

    /**
     * @return Collection
     */
    static public function getMostChangingPosts()
    {
        $posts = Post::has('history', '>=', 1)->withCount('history')->get();
        $maxChangingPosts = $posts->where('history_count', $posts->max('history_count'));

        return $maxChangingPosts;
    }

    /**
     * @return Collection
     */

    static public function getMostCommentPosts()
    {
        $posts = Post::has('comments', '>=', 1)->withCount('comments')->get();
        $mostCommentPosts = $posts->where('comments_count', $posts->max('comments_count'));

        return $mostCommentPosts;
    }
}
