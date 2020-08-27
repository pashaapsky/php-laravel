@extends('layouts.app')

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
    <div class="container">
        <section class="posts-section mb-2">
            <h2 class="posts-section__header">Most recent posts</h2>

            @if ($posts->count())
                <div class="posts-section__posts row post">
                    @foreach($posts as $post)
                        <div class="post__item col-md-6">
                            <div class="post__intro row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                <div class="post__heading col-6 p-4 d-flex flex-column position-static">
                                    <strong class="d-inline-block mb-2 text-primary">Post #{{ $post->id }}</strong>

                                    <h3 class="mb-0">{{ $post->name }}</h3>

                                    <div class="mb-1 text-muted">{{ $post->created_at->toFormattedDateString() }}</div>

                                    <p class="card-text mb-auto text-justify "> {{ str_limit($post->text, $limit = 118, $end = '...') }} </p>

                                    <a href="{{ route('post-show', $post->id) }}" class="stretched-link">Continue reading</a>
                                </div>

                                <div class="col-6 d-none d-lg-block">
                                    <svg class="bd-placeholder-img" width="auto" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                                        <title>Placeholder</title>
                                        <rect width="100%" height="100%" fill="#55595c"></rect>
                                        <text x="40%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class=""></p>
            @endif
        </section>
    </div>
@endsection

@section('footer')
    @include('layouts.base.footer')
@endsection
