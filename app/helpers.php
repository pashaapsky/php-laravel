<?php

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
