@extends('layouts.app')

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
    <main class="py-4" style="min-height: 88vh">
        <div class="container">
            <section class="posts-section mb-2">
                <h2 class="posts-section__header">Posts</h2>

                @if ($posts->count())
                    <div class="posts-section__posts row post">
                        @foreach($posts as $post)
                            <div class="post__item col-md-6 ">
                                <div class="post__intro text-break row py-2 no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                    <div class="post__heading col-6 p-4 d-flex flex-column position-static">
                                        <strong class="d-inline-block mb-2 text-primary">Post #{{ $post->id }}</strong>

                                        <h3 class="post__name mb-0">{{ $post->name }}</h3>

                                        <div class="post__created-at mb-1 text-muted">{{ $post->created_at->toFormattedDateString() }}</div>

                                        <p class="post__preview card-text mb-auto text-justify" style="height: 115px"> {{ str_limit($post->text, $limit = 100, $end = '...') }} </p>

                                        @if($post->tags->isNotEmpty())
                                            <div class="post__tags mb-2">
                                                @foreach($post->tags as $tag)
                                                    <span class="badge badge-info text-white">{{ $tag->name }}</span>
                                                @endforeach
                                            </div>
                                        @endif

                                        <a href="{{ route('post-show', $post->id) }}" class="post__view">Continue reading</a>
                                    </div>

                                    <div class="post__photo col-6 d-none d-lg-flex align-items-center p-2">
                                        <svg class="bd-placeholder-img" width="auto" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                                            <title>Placeholder</title>
                                            <rect width="100%" height="100%" fill="#55595c"></rect>
                                            <text x="35%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                                        </svg>
                                    </div>

                                    <div class="d-flex col-12 justify-content-end pr-2">
                                        <a href="/posts/{{ $post->id }}/edit" class="btn btn-outline-secondary" style="width: 80px; font-size: 0.7rem">Edit</a>

                                        <form method="post" action="/posts/{{ $post->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-secondary" style="width: 80px; font-size: 0.7rem">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="no-posts">No available posts yet</p>
                @endif
            </section>
        </div>
    </main>
@endsection

@section('footer')
    @include('layouts.base.footer')
@endsection
