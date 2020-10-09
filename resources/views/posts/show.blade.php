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

                <div class="post__comments comments mb-3">
                    <h3 class="comments__heading">Comments</h3>

                    <div class="comments__intro">
                        @forelse($post->comments as $comment)
                            <div class="comments__item position-relative border rounded shadow-sm p-3 mb-1">
                                <div class="comment__id text-primary">Comment from #{{ $comment->id }}</div>
                                <div class="comment__text text-justify">{{ $comment->text }}</div>
                                <div class="comment__date position-absolute" style="top: 1rem; right: 10px">{{ $comment->created_at }}</div>

                                @if(auth()->user() && auth()->user()->hasRole('admin'))
                                    <form method="post" action="{{ route('comments.destroy', $comment) }}" class="d-flex justify-content-end mt-1">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-outline-secondary btn-sm" style="">Delete</button>
                                    </form>
                                @endif
                            </div>
                        @empty
                            <p class="new__comments none">
                                No comments yet
                            </p>
                        @endforelse
                    </div>

                    <form method="post" class="needs-validation my-2" action="{{ route('comments.posts.store', $post) }}" novalidate>
                        @csrf

                        <h5 class="header">Add comment</h5>

                        <div class="form__fields row d-flex flex-column">
                            <div class="form__field d-flex flex-column col-12 mb-3">
                                <label for="form-text"></label>
                                <textarea name="text"
                                          class="form-control @error('text') is-invalid @enderror"
                                          id="form-text"
                                          cols="30"
                                          rows="4"
                                          placeholder="Text here"
                                          required="">{{ old('text') }}</textarea>

                                <div class="invalid-feedback">
                                    Comment Text is required.
                                </div>

                                @error('text')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <button class="btn btn-outline-secondary" type="submit">Create</button>
                    </form>
                </div>

                <div class="post__history history">
                    <h3 class="history__heading">History of changes</h3>

                    <div class="history__intro">
                        @forelse($post->history as $history)
                            <div class="history__item position-relative border rounded shadow-sm p-3 mb-1">
                                <div class="history__user">{{ $history->user_email }}</div>
                                <div class="history__text text-justify">{{ $history->text }}</div>
                                <div class="history__date position-absolute" style="top: 1rem; right: 10px">{{ $history->created_at->diffForHumans() }}</div>
                            </div>
                        @empty
                            <p class="history__clear">
                                No post changes yet
                            </p>
                        @endforelse
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-secondary mx-1" style="width: 80px; font-size: 0.7rem">Edit</a>

                        <form method="post" action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-outline-secondary" style="width: 80px; font-size: 0.7rem">Delete</button>
                        </form>
                </div>
            </div>
        </section>
    </div>
@endsection


@section('footer')
    @include('layouts.base.footer')
@endsection
