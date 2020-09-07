@extends('layouts.app')

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
    <div class="container">
        <section class="post-show my-3">
            <h2 class="post-show header text-primary"><strong>Post #{{ $post->id }}</strong></h2>

            <div class="post-show__content post row d-flex flex-column">
                <div class="post__intro d-flex w-100 border no-gutters rounded mb-4 shadow-sm position-relative">
                    <div class="post__heading col-6 p-3 d-flex flex-column justify-content-top position-static">
                        <h4 class="post__name mb-2">Name : {{ $post->name }}</h4>

                        <div class="post__created-at mb-2 text-muted">Created at :
                            {{ $post->created_at->toFormattedDateString() }}
                        </div>

                        <div class="post__description">
                            <strong>Post description</strong>

                            <p class="description text-muted">{{ $post->description }}</p>
                        </div>
                    </div>

                    <div class="col-6 d-none d-lg-block">
                        <svg class="bd-placeholder-img" width="auto" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"></rect>
                            <text x="40%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                        </svg>
                    </div>
                </div>

                <div class="post__text mb-3">
                    <h3 class="post__heading ml-3">Post content</h3>

                    <p class="card-text mb-auto p-3 text-justify border rounded shadow-sm" style="min-height: 42vh"> {{ $post->text }} </p>
                </div>

                <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary align-self-end" style="width: 100px">Edit post</a>
            </div>
        </section>
    </div>
@endsection


@section('footer')
    @include('layouts.base.footer')
@endsection
