<?php

namespace App\Http\Controllers;

use App\Services\StatisticService;

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
        $statisticService = new StatisticService();

        $postsCount = $statisticService->getPostsCount();

        //Общее количество новостей
        $newsCount = $statisticService->getNewsCount();

        //ФИО автора, у которого больше всего статей на сайте
        $usersWithMostPosts = $statisticService->getUserWithMaxPosts();

        //Самая длинная статья - название, ссылка на статью и длина статьи в символах
        $theLongestPost = $statisticService->getTheLongestPost();

        //Самая короткая статья - название, ссылка на статью и длина статьи в символах
        $theShortestPost = $statisticService->getTheShortestPost();

        //Средние количество статей у “активных” пользователей, при этом активным пользователь считается, если у него есть более 1-й статьи
        $avgPostsHaveActiveUsers = $statisticService->getAveragePosts();

        //Самая непостоянная - название, ссылка на статью, которую меняли больше всего раз
        $mostChangingPosts = $statisticService->getMostChangingPost();

        //Самая обсуждаемая статья  - название, ссылка на статью, у которой больше всего комментариев.
        $mostCommentPosts = $statisticService->getMostCommentPost();

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

//        dd($theShortestPost);

        return view('static.statistics', ['statistics' => $statistics]);
    }
}
