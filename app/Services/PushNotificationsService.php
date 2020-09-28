<?php

namespace App\Services;

use GuzzleHttp\Client;

class PushNotificationsService
{
    private $apiID;
    private $apiKey;

    public function __construct($api_id, $api_key)
    {
        $this->apiID = $api_id;
        $this->apiKey= $api_key;
    }

    public function send($text, $title)
    {
        $data = [
            'type' => 'self',
            'id' => $this->apiID,
            'key' => $this->apiKey,
            'text' => $text,
            'title' => $title
        ];

        $client = new Client([
            'base_uri' => 'https://pushall.ru/api.php',
        ]);

        $response = $client->request('POST', '', [
            'form_params' => $data
        ]);

        return $response;
    }
}
