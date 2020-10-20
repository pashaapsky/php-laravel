<?php

namespace App\Http\Controllers;

use App\Services\StatisticService;

class StaticPagesController extends Controller
{
    protected $statisticService;

    public function __construct(StatisticService $statisticService)
    {
        $this->statisticService = $statisticService;
    }

    public function contactsIndex() {
        return view('static.contacts');
    }

    public function aboutIndex() {
        return view('static.about');
    }

    public function statisticsIndex() {
        //Общее количество статей
        $postsCount = $this->statisticService->getPostsCount();

        //Общее количество новостей
        $newsCount = $this->statisticService->getNewsCount();

        //ФИО автора, у которого больше всего статей на сайте
        $userWithMostPosts = $this->statisticService->getUserWithMaxPosts();

        //Самая длинная статья - название, ссылка на статью и длина статьи в символах
        $theLongestPost = $this->statisticService->getTheLongestPost();

        //Самая короткая статья - название, ссылка на статью и длина статьи в символах
        $theShortestPost = $this->statisticService->getTheShortestPost();

        //Средние количество статей у “активных” пользователей, при этом активным пользователь считается, если у него есть более 1-й статьи
        $avgPostsHaveActiveUsers = $this->statisticService->getAveragePosts();

        //Самая непостоянная - название, ссылка на статью, которую меняли больше всего раз
        $mostChangingPost = $this->statisticService->getMostChangingPost();

        //Самая обсуждаемая статья  - название, ссылка на статью, у которой больше всего комментариев.
        $mostCommentPost = $this->statisticService->getMostCommentPost();

        $statistics = [
            'posts_count' => $postsCount,
            'news_count' => $newsCount,
            'user_with_most_posts' => $userWithMostPosts,
            'the_longest_post' => $theLongestPost,
            'the_shortest_post' => $theShortestPost,
            'avg_posts_have_active_users' => $avgPostsHaveActiveUsers,
            'most_changing_post' => $mostChangingPost,
            'most_comment_post' => $mostCommentPost
        ];

        return view('static.statistics', ['statistics' => $statistics]);
    }
}
