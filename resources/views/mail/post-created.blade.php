@component('mail::message')
# Создана новая задача {{ $post->name }}

{{ $post->text }}

@component('mail::button', ['url' => '/posts/' . $post->id])
Смотреть
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
