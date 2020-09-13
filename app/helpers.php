<?php

function flash($message, $type = 'success') {
    session()->flash('message', $message);
    session()->flash('message_type', $type);
}

function sendMailNotifyToAdmin($mailView) {
    $admin = \App\User::where('email', env('ADMIN_EMAIL_FOR_NOTIFICATIONS'))->first();

    if ($admin) {
        $admin->notify($mailView);
    }
}
