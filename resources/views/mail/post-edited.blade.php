@component('mail::message')
# Запись {{ $post->name }} успешно изменена

{{ $post->text }}

@component('mail::button', ['url' => '/posts/' . $post->id])
    Смотреть
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
