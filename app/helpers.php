<?php

use App\Post;
use App\Tag;
use App\Taggable;
use App\User;

if (! function_exists('flash')) {
    /**
     * @param $message
     * @param string $type
     */
    function flash($message, $type = 'success') {
        session()->flash('message', $message);
        session()->flash('message_type', $type);
    }
}


if (! function_exists('sendMailNotifyToAdmin')) {

    /**
     * @param $mailView
     */

    function sendMailNotifyToAdmin($mailView) {
        $admin = User::where('email', env('ADMIN_EMAIL_FOR_NOTIFICATIONS'))->first();

        if ($admin) {
            $admin->notify($mailView);
        }
    }
}


if (! function_exists('pushNotification')) {

    /**
     * @param null $text
     * @param null $title
     * @return \App\Services\PushNotificationsService|mixed
     */
    function pushNotification($text = null, $title = null) {
        if (is_null($text) || is_null($title)) {
            return app(\App\Services\PushNotificationsService::class);
        }

        return app(\App\Services\PushNotificationsService::class)->send($text, $title);
    }
}

if (! function_exists('updateTags')) {
    /**
     * @param $model
     * @param $request
     * @param $pivotTable
     */

    function updateTags($model, $request) {
        $modelTags = $model->tags->keyBy('name');

        if (!is_null($request['tags'])) {
            $requestTags = collect(explode(', ', $request['tags']))->keyBy(function ($item) { return $item; });
        } else {
            $requestTags = collect([]);
        }

        $deleteTags = $modelTags->diffKeys($requestTags);
        $addTags = $requestTags->diffKeys($modelTags);

        if ($addTags->isNotEmpty()) {
            foreach ($addTags as $tag) {
                $tag = Tag::firstOrCreate(['name' => $tag]);
                $model->tags()->attach($tag);
            };
        }

        if ($deleteTags->isNotEmpty()) {
            foreach ($deleteTags as $tag) {
                $model->tags()->detach($tag);
                $isLastTag = Taggable::where('tag_id', $tag->id)->first();
                if (!$isLastTag) $tag->delete();
            };
        }
    }
}


if (! function_exists('getUserWithMaxPosts')) {
    /**
     * @return array
     */

    function getUserWithMaxPosts() {
        $usersWithPostsCount = User::withCount('posts')->get();

        $maxPosts = 0;
        $usersWithMaxPosts = [];

        foreach ($usersWithPostsCount as $user) {
            if ($user->posts_count > $maxPosts) {
                $usersWithMaxPosts = [];

                $maxPosts = $user->posts_count;
                array_push($usersWithMaxPosts, $user);
            } elseif ($user->posts_count = $maxPosts) {
                array_push($usersWithMaxPosts, $user);
            }
        }

        if (!empty($usersWithMaxPosts)) {
            return $usersWithMaxPosts;
        }
    }
}

if (! function_exists('getTheLongestPosts')) {
    /**
     * @return array
     */

    function getTheLongestPosts() {
        $maxLength = 0;
        $postsWithMaxTextLength = [];

        foreach (Post::all() as $post) {
            $len = mb_strlen($post->text);

            if ($len > $maxLength) {
                $postsWithMaxTextLength = [];

                $maxLength = mb_strlen($post->text);
                array_push($postsWithMaxTextLength, $post);
            } elseif ($len === $maxLength) {
                array_push($postsWithMaxTextLength, $post);
            }
        }

        if (!empty($postsWithMaxTextLength)) {
            return $postsWithMaxTextLength;
        }
    }
}

if (! function_exists('getTheShortestPosts')) {
    /**
     * @return array
     */

    function getTheShortestPosts() {
        $isFirst = true;
        $postsWithMinTextLength = [];

        foreach (Post::all() as $post) {
            if ($isFirst) {
                $maxLength = mb_strlen($post->text);
                $isFirst = false;
            }

            $len = mb_strlen($post->text);

            if ($len < $maxLength) {
                $postsWithMinTextLength = [];

                $maxLength = $len;
                array_push($postsWithMinTextLength, $post);
            } elseif ($len === $maxLength) {
                array_push($postsWithMinTextLength, $post);
            }
        }

        if (!empty($postsWithMinTextLength)) {
            return $postsWithMinTextLength;
        }
    }
}

if (! function_exists('getAveragePosts')) {
    /**
     * @return int
     */

    function getAveragePosts() {
        $activeUsers = [];
        $activeUsersPostsCount = 0;

        $users = User::withCount('posts')->get();

        foreach ($users as $user) {
            if ($user->posts_count >= 1) {
                array_push($activeUsers, $user);
                $activeUsersPostsCount += $user->posts_count;
            }
        }

        if (!empty($activeUsers)) {
            $result = intval(round($activeUsersPostsCount / count($activeUsers), 0));

            return $result;
        }
    }
}

if (! function_exists('getMostChangingPosts')) {
    /**
     * @return array
     */

    function getMostChangingPosts() {
        $mostChangingPosts = [];
        $postsWithChanges = Post::has('history', '>=', 1)->withCount('history')->get();

        $changeCount = 0;

        foreach ($postsWithChanges as $post) {
            if ($post->history_count > $changeCount) {
                $mostChangingPosts = [];
                $changeCount = $post->history_count;

                array_push($mostChangingPosts, $post);
            } elseif ($post->history_count === $changeCount) {
                array_push($mostChangingPosts, $post);
            }
        }

        if (!empty($mostChangingPosts)) {
            return $mostChangingPosts;
        }
    }
}

if (! function_exists('getMostCommentPosts')) {
    /**
     * @return array
     */

    function getMostCommentPosts() {
        $mostCommentPosts = [];
        $postsWithComments = Post::has('comments', '>=', 1)->withCount('comments')->get();

        $commentsCount = 0;

        foreach ($postsWithComments as $post) {
            if ($post->comments_count > $commentsCount) {
                $mostCommentPosts = [];
                $commentsCount = $post->comments_count;

                array_push($mostCommentPosts, $post);
            } elseif ($post->comments_count === $commentsCount) {
                array_push($mostCommentPosts, $post);
            }
        }

        if (!empty($mostCommentPosts)) {
            return $mostCommentPosts;
        }
    }
}




