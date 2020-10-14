<?php

namespace App\Http\Controllers;

use App\Services\GetStatisticService;

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
        $postsCount = GetStatisticService::getPostsCount();

        //Общее количество новостей
        $newsCount = GetStatisticService::getNewsCount();

        //ФИО автора, у которого больше всего статей на сайте
        $usersWithMostPosts = GetStatisticService::getUserWithMaxPosts();

        //Самая длинная статья - название, ссылка на статью и длина статьи в символах
        $theLongestPost = GetStatisticService::getTheLongestPosts();

        //Самая короткая статья - название, ссылка на статью и длина статьи в символах
        $theShortestPost = GetStatisticService::getTheShortestPosts();

        //Средние количество статей у “активных” пользователей, при этом активным пользователь считается, если у него есть более 1-й статьи
        $avgPostsHaveActiveUsers = GetStatisticService::getAveragePosts();

        //Самая непостоянная - название, ссылка на статью, которую меняли больше всего раз
        $mostChangingPosts = GetStatisticService::getMostChangingPosts();

        //Самая обсуждаемая статья  - название, ссылка на статью, у которой больше всего комментариев.
        $mostCommentPosts = GetStatisticService::getMostCommentPosts();

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
