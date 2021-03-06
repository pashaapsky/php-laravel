<?php

namespace App\Listeners;

use App\Events\PostUpdated;
use App\Events\PostUpdatedAdminChat;

class AddHistoryOnUpdatePost
{
    public function __construct()
    {

    }

    public function handle(PostUpdated $event)
    {
        $result = '';

        $dirtyValues = $event->post->getChanges();
        $freshValues = $event->post->getOriginal();
        unset($dirtyValues['updated_at']);

        if ($dirtyValues['published'] === true && $freshValues['published'] === 1) {
            unset($dirtyValues['published']);
        }

        foreach ($dirtyValues as  $key => $field) {
            $result .= 'Изменено поле: "' . $key . '". Было: "' . $freshValues[$key] . '". Стало: "' .  $field . '"' . PHP_EOL;
        }

        $values = [
          'user_email' => auth()->user()->email,
          'text' => $result
        ];

        if (!empty($result)) {
            $event->post->history()->create($values);

            event(new PostUpdatedAdminChat($event->post, $result));
        }
    }
}
