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
                                Общее количество новостей на сайте :
                                <strong>{{ $statistics['news_count'] }}</strong>
                            </li>
                        @endif

                        @if(!is_null($statistics['users_with_most_posts']))
                            <li class="statistic__item list-group-item">
                                Авторы с наибольшим количеством статей на сайте :
                                @foreach($statistics['users_with_most_posts'] as $key => $user)
                                    <div class="values">
                                        {{ $key + 1 }}. <span>{{ $user->name }}</span>

                                        <a href="" class="text-primary">{{ $user->email }}</a> -

                                        <strong>{{ $user->posts_count }}</strong>
                                    </div>
                                @endforeach
                            </li>
                        @endif

                        @if(!is_null($statistics['the_longest_posts']))
                            <li class="statistic__item list-group-item">
                                Самая длинная статья на сайте.
                                <div class="values">
                                    <span>Название статьи:
                                        <a href="{{ route('posts.show', $statistics['the_longest_posts']) }}">{{ $statistics['the_longest_posts']->name }}</a> -
                                        <strong>{{ mb_strlen($statistics['the_longest_posts']->text) }}</strong>
                                    </span>
                                </div>
                            </li>
                        @endif

                        @if(!is_null($statistics['the_shortest_posts']))
                            <li class="statistic__item list-group-item">
                                Самая короткая статья на сайте.
                                <div class="values">
                                    <span>Название статьи:
                                        <a href="{{ route('posts.show', $statistics['the_shortest_posts']) }}">{{ $statistics['the_shortest_posts']->name }}</a> -
                                        <strong>{{ mb_strlen($statistics['the_shortest_posts']->text) }}</strong>
                                    </span>
                                </div>
                            </li>
                        @endif

                        @if(!is_null($statistics['avg_posts_have_active_users']))
                            <li class="statistic__item list-group-item">
                                Среднее количество статей у "активных" пользователей -
                                <strong>{{ $statistics['avg_posts_have_active_users'] }}</strong>
                            </li>
                        @endif

                        @if(!is_null($statistics['most_changing_posts']))
                            <li class="statistic__item list-group-item">
                                Самая часто изменяемая статья на сайте.
                                @foreach($statistics['most_changing_posts'] as $key => $post)
                                    <div class="values">
                                        {{ $key + 1 }}.
                                        <span>Название статьи:
                                            <a href="{{ route('posts.show', $post) }}">{{ $post->name }}</a> -
                                            <strong>{{ $post->history_count }}</strong>
                                        </span>
                                    </div>
                                @endforeach
                            </li>
                        @endif

                        @if(!is_null($statistics['most_comment_posts']))
                            <li class="statistic__item list-group-item">
                                Самая обсуждаемая статья на сайте.
                                @foreach($statistics['most_comment_posts'] as $key => $post)
                                    <div class="values">
                                        {{ $key + 1 }}.
                                        <span>Название статьи:
                                        <a href="{{ route('posts.show', $post) }}">{{ $post->name }}</a> -
                                        <strong>{{ $post->comments_count }}</strong>
                                    </span>
                                    </div>
                                @endforeach
                            </li>
                        @endif
                    </ul>
                </div>
            </section>
        </div>
    </main>
@endsection

@section('footer')
    @include('layouts.base.footer')
@endsection
