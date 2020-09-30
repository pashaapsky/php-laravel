@component('mail::message')

# Новые посты, которые могут быть Вам интересны:

@foreach($posts as $post)
<b>{{ mb_strtoupper($post->name) }}</b>

{{ $post->text }}

@component('mail::button', ['url' => '/posts/' . $post->id])
    Смотреть
@endcomponent
@endforeach

Thanks,<br>
{{ config('app.name') }}
@endcomponent
