<?php

namespace App\Listeners;

use App\Events\PostUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddHistoryOnUpdatePost
{
    public function __construct()
    {

    }

    public function handle(PostUpdated $event)
    {
        $result = '';

        $dirtyValues = $event->post->getDirty();
        unset($dirtyValues['updated_at']);
        $freshValues = $event->post->fresh()->toArray();

        if ($dirtyValues['published'] === true && $freshValues['published'] === 1) {
            unset($dirtyValues['published']);
        }

        foreach ($dirtyValues as  $key => $field) {
            $result = 'Изменено поле ' . $key . ' Было ' . $freshValues[$key] . ' Стало ' .  $field . PHP_EOL;
        }

        $values = [
          'user_email' => auth()->user()->email,
          'text' => $result
        ];

        $event->post->history()->create($values);
    }
}
