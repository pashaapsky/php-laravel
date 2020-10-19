<?php

namespace App\Services;

use App\News;
use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class StatisticService
{
    /**
     * Количество постов на сайте
     * @return int
     */
    public function getPostsCount()
    {
        return Post::count();
    }

    /**
     * Общее количество новостей
     * @return int
     */
    public function getNewsCount()
    {
        return News::count();
    }


    /**
     * @return User
     */

    public function getUserWithMaxPosts()
    {
        $userWithMostPostsCount = User::has('posts')->withCount('posts')->orderBy('posts_count', 'desc')->first();

//        $users = DB::table('users')
//            ->join('posts', 'users.id', '=', 'owner_id')
//            ->select('users.name', DB::raw('Count(*) as posts_count'))
//            ->groupBy('users.name')
//            ->orderByDesc('posts_count')
//            ->first();

        return $userWithMostPostsCount;
    }


    /**
     * @return Post
     */

    public function getTheLongestPost()
    {
        $theLongestPost = Post::where(DB::raw('Length(text)'), function($query){
            $query->select(DB::raw('MAX(Length(text))'))
                ->from(DB::table('posts'));
        })->first();

        return $theLongestPost;
    }

    /**
     * @return Post
     */

    public function getTheShortestPost()
    {
        $theShortestPost = Post::where(DB::raw('Length(text)'), function($query){
            $query->select(DB::raw('MIN(Length(text))'))
                ->from(DB::table('posts'));
        })->first();

        return $theShortestPost;
    }

    /**
     * @return int
     */

    public function getAveragePosts()
    {
        $posts = User::has('posts', '>', 1)->withCount('posts')->get();
        $averagePosts = intval(round($posts->avg('posts_count')));

//        $averagePosts = DB::select('select AVG(u.posts_count) as avg_posts_count from (select users.*, (select Count(*) from posts where users.id = posts.owner_id) as posts_count from users) as u')[0];
//        $averagePosts = intval(round($averagePosts->avg_posts_count));

        return $averagePosts;
    }

    /**
     * @return Post
     */

    public function getMostChangingPost()
    {
        $maxChangingPost = Post::has('history', '>=', 1)->withCount('history')->orderBy('history_count', 'desc')->first();

//        $maxHistoryCount = DB::table('posts')
//            ->join('histories as h', 'posts.id', '=', 'h.post_id')
//            ->select('posts.name', DB::raw('Count(*) as history_count'))
//            ->groupBy('posts.name')
//            ->orderByDesc('history_count')
//            ->first()
//        ;

        return $maxChangingPost;
    }

    /**
     * @return Collection
     */

    public function getMostCommentPost()
    {
        $mostCommentPost = Post::has('comments', '>=', 1)->withCount('comments')->orderBy('comments_count', 'desc')->first();

//        $maxComment = DB::table('posts')
//            ->join('comments as c', function ($join) {
//                $join->on('posts.id', '=', 'c.commentable_id')
//                    ->where('c.commentable_type', '=', 'App\Post');
//            })
//            ->select('posts.name', DB::raw('Count(*) as comments_count'))
//            ->groupBy('posts.name')
//            ->orderByDesc('comments_count')
//            ->first()
//        ;

        return $mostCommentPost;
    }
}
