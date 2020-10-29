@component('mail::message')
# Был сформирован итоговый отчет:
@if(array_key_exists('news', $data))
<p>{{ $data['news'] }}</p>
@endif
@if(array_key_exists('posts', $data))
<p>{{ $data['posts'] }}</p>
@endif
@if(array_key_exists('comments', $data))
<p>{{ $data['comments'] }}</p>
@endif
@if(array_key_exists('tags', $data))
<p>{{ $data['tags'] }}</p>
@endif
@if(array_key_exists('users', $data))
<p>{{ $data['users'] }}</p>
@endif
Спасибо, <br>
{{ config('app.name') }}
@endcomponent
