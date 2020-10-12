@extends('layouts.app')

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
    <main class="py-4" style="min-height: 88vh">
        <div class="container">
            <section class="statistic-section mb-2">
                <h2 class="statistic-section__header">Interesting Facts</h2>

                <div class="statistic-things statistic">
                    <ul class="statistic__list list-group">
                        @if(!is_null($statistics['posts_count']))
                            <li class="statistic__item list-group-item">
                                Общее количество статей на сайте :
                                <strong>{{ $statistics['posts_count'] }}</strong>
                            </li>
                        @endif

                        @if(!is_null($statistics['news_count']))
                            <li class="statistic__item list-group-item">
                                Общее количество новостей :
                                <strong>{{ $statistics['news_count'] }}</strong>
                            </li>
                        @endif

                        <li class="statistic__item list-group-item">
                            ФИО автора, у которого больше всего статей на сайте :
{{--                            @foreach()--}}

{{--                            @endforeach--}}
                        </li>

                        <li class="statistic__item list-group-item">
                            Самая длинная статья - название, ссылка на статью и длина статьи в символах
                        </li>

                        <li class="statistic__item list-group-item">
                            Самая короткая статья - название, ссылка на статью и длина статьи в символах
                        </li>

                        <li class="statistic__item list-group-item">
                            Средние количество статей у “активных” пользователей, при этом активным пользователь считается, если у него есть более 1-й статьи
                        </li>

                        <li class="statistic__item list-group-item">
                            Самая непостоянная - название, ссылка на статью, которую меняли больше всего раз
                        </li>

                        <li class="statistic__item list-group-item">
                            Самая обсуждаемая статья  - название, ссылка на статью, у которой больше всего комментариев.
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </main>
@endsection

@section('footer')
    @include('layouts.base.footer')
@endsection
