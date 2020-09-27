<?php

use GuzzleHttp\Client;

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

function pushNotification($text, $title = 'Уведомление') {
    $id = env('PUSH_ALL_API_ID');
    $key = env('PUSH_ALL_API_KEY');

    $data =  [
        'type' => 'self',
        'id' => $id,
        'key' => $key,
        'text' => $text,
        'title' => $title
    ];

    $client = new Client([
        'base_uri' => 'https://pushall.ru/api.php',
    ]);

    $response = $client->request('POST', '', [
        'form_params' => $data
    ]);
}
