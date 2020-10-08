@extends('layouts.app')

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
    <main class="py-4" style="min-height: 88vh">
        <div class="container">
            <div class="intro row">
                <section class="view-block col-12 col-sm-8 col-lg-10 order-2 order-sm-0">
                    <h2 class="view-block__header text-center">Find results</h2>

                    @if ($posts->count())
                        <div class="view-block__item post">
                            <h3 class="">Posts</h3>

                            <div class="post__block">
                                @foreach($posts as $post)
                                    <div class="post__item">
                                        <div class="post__intro text-break row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                            <div class="post__heading col-12 col-lg-6 p-4 d-flex flex-column" style="height: 280px;">
                                                <strong class="d-inline-block mb-2 text-primary">Post #{{ $post->id }}</strong>

                                                <h3 class="post__name mb-0">{{ $post->name }}</h3>

                                                <div class="post__created-at mb-1 text-muted">{{ $post->created_at->toFormattedDateString() }}</div>

                                                <p class="post__preview card-text mb-auto text-justify"> {{ str_limit($post->text, $limit = 100, $end = '...') }} </p>

                                                @if($post->tags->isNotEmpty())
                                                    <div class="post__tags mb-2">
                                                        @foreach($post->tags as $tag)
                                                            <a href="{{ route('tags.show', $tag) }}" class="badge badge-info text-white">{{ $tag->name }}</a>
                                                        @endforeach
                                                    </div>
                                                @endif

                                                <a href="{{ route('posts.show', $post->id) }}" class="post__view">Continue reading</a>
                                            </div>

                                            <div class="post__photo col-6 d-none d-lg-flex align-items-center p-2">
                                                <svg class="bd-placeholder-img" width="auto" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                                                    <title>Placeholder</title>
                                                    <rect width="100%" height="100%" fill="#55595c"></rect>
                                                    <text x="35%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($news->count())
                        <div class="view-block__item new">
                            <h3 class="">News</h3>

                            @foreach($news as $new)
                                <div class="new__item d-flex">
                                    <div class="new__heading d-flex flex-column p-3 w-100 border rounded mb-4 shadow-sm">
                                        <strong class="mb-2 text-primary">new #{{ $new->id }}</strong>

                                        <h3 class="new__name mb-0">{{ $new->name }}</h3>

                                        <div class="new__created-at mb-1 text-muted">{{ $new->created_at->toFormattedDateString() }}</div>

                                        <p class="new__preview card-text flex-grow-1 text-justify">  {{ str_limit($new->text, $limit = 100, $end = '...') }} </p>

                                        @if($new->tags->isNotEmpty())
                                            <div class="post__tags mb-2">
                                                @foreach($new->tags as $tag)
                                                    <a href="{{ route('tags.show', $tag) }}" class="badge badge-info text-white">{{ $tag->name }}</a>
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('news.show', $new) }}" class="btn btn-outline-secondary" style="width: 80px; font-size: 0.7rem">Read</a>

                                            @if(auth()->user() && auth()->user()->hasRole('admin'))
                                                <a href="{{ route('news.edit', $new) }}" class="btn btn-outline-secondary mx-1" style="width: 80px; font-size: 0.7rem">Edit</a>

                                                <form method="post" action="{{ route('news.destroy', $new) }}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-outline-secondary" style="width: 80px; font-size: 0.7rem">Delete</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>

                @include('layouts.aside-tags')
            </div>
        </div>
    </main>
@endsection

@section('footer')
    @include('layouts.base.footer')
@endsection
