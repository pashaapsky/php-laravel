@extends('layouts.app')

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
    <div class="container">
        <section class="new-show my-3 d-flex flex-column" style="min-height: 87vh">
            <h2 class="new-show header text-primary"><strong>New #{{ $new->id }}</strong></h2>

            <div class="new-show__content new d-flex flex-column flex-grow-1">
                <div class="new__intro d-flex w-100 border no-gutters rounded shadow-sm position-relative mb-3">
                    <div class="new__heading col-6 p-3 d-flex flex-column justify-content-top position-static">
                        <h4 class="new__name mb-2">Name : {{ $new->name }}</h4>

                        <div class="new__created-at mb-2 text-muted">Created at :
                            {{ $new->created_at->toFormattedDateString() }}
                        </div>
                    </div>
                </div>

                <div class="new__text mb-3">
                    <h3 class="new__heading ml-3">Text</h3>

                    <p class="card-text mb-auto p-3 text-justify border rounded shadow-sm"> {{ $new->text }} </p>
                </div>

                <div class="new__comments comments mb-3">
                    <h3 class="comments__heading">Comments</h3>

                    <div class="comments__intro">
                        @forelse($new->comments as $comment)
                            <div class="comments__item position-relative border rounded shadow-sm p-3 mb-1">
                                <div class="comment__id text-primary">Comment from #{{ $comment->id }}</div>
                                <div class="comment__text">{{ $comment->text }}</div>
                                <div class="comment__date position-absolute" style="top: 1rem; right: 10px">{{ $comment->created_at }}</div>

                                @if(auth()->user() && auth()->user()->hasRole('admin'))
                                    //
                                @endif
                            </div>
                        @empty
                            <p class="new__comments none">
                                No comments yet
                            </p>
                        @endforelse
                    </div>
                </div>

                <form method="post" class="needs-validation my-2" action="{{ route('comments.store', $new) }}" novalidate>
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

            <div class="d-flex justify-content-end">
                <a href="{{ route('news.edit', $new) }}" class="btn btn-outline-secondary mx-1" style="width: 80px; font-size: 0.7rem">Edit</a>

                <form method="post" action="{{ route('news.destroy', $new) }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-outline-secondary" style="width: 80px; font-size: 0.7rem">Delete</button>
                </form>
            </div>
        </section>
    </div>
@endsection

@section('footer')
    @include('layouts.base.footer')
@endsection
