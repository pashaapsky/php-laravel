<?php

namespace App\Http\Controllers;

use App\News;
use App\Post;

class StaticPagesController extends Controller
{
    public function contactsIndex() {
        return view('static.contacts');
    }

    public function aboutIndex() {
        return view('static.about');
    }

    public function statisticsIndex() {
        //Общее количество статей
        $postsCount = Post::all()->count();

        //Общее количество новостей
        $newsCount = News::all()->count();

        //ФИО автора, у которого больше всего статей на сайте
        $usersWithMostPosts = getUserWithMaxPosts();

        //Самая длинная статья - название, ссылка на статью и длина статьи в символах
        $theLongestPost = getTheLongestPosts();

        //Самая короткая статья - название, ссылка на статью и длина статьи в символах
        $theShortestPost = getTheShortestPosts();

        //Средние количество статей у “активных” пользователей, при этом активным пользователь считается, если у него есть более 1-й статьи
        $avgPostsHaveActiveUsers = getAveragePosts();

        //Самая непостоянная - название, ссылка на статью, которую меняли больше всего раз
        $mostChangingPosts = getMostChangingPosts();

        //Самая обсуждаемая статья  - название, ссылка на статью, у которой больше всего комментариев.
        $mostCommentPosts = getMostCommentPosts();

        $statistics = [
            'posts_count' => $postsCount,
            'news_count' => $newsCount,
            'users_with_most_posts' => $usersWithMostPosts,
            'the_longest_posts' => $theLongestPost,
            'the_shortest_posts' => $theShortestPost,
            'avg_posts_have_active_users' => $avgPostsHaveActiveUsers,
            'most_changing_posts' => $mostChangingPosts,
            'most_comment_posts' => $mostCommentPosts
        ];

        return view('static.statistics', ['statistics' => $statistics]);
    }
}
