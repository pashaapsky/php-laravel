<?php

use App\Tag;

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
        $admin = \App\User::where('email', env('ADMIN_EMAIL_FOR_NOTIFICATIONS'))->first();

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

    function updateTags($model, $request, $pivotTable) {
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
                $isLastTag = $pivotTable::where('tag_id', $tag->id)->first();
                if (!$isLastTag) $tag->delete();
            };
        }
    }
}

