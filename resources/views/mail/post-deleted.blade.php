@component('mail::message')
# Запись {{ $post->name }} успешно удалена

{{ $post->text }}

@component('mail::button', ['url' => '/'])
    Перейти на сайт
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
