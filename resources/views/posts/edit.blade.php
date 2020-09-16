@extends('layouts.app')

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
    <main class="d-flex py-4" style="min-height: 88vh">
        <div class="container">
            <section class="post-edit mb-2">
                <h2 class="post-edit__header mb-4"><strong>Edit post #{{ $post->id }}</strong></h2>

                <form class="post-edit__form form d-flex flex-column needs-validation" method="post" action="/posts/{{ $post->id }}" novalidate>
                    @csrf
                    @method('patch')

                    <div class="form__fields row d-flex flex-column">
                        <div class="form__field col-6 mb-3">
                            <label for="form-code">Code</label>
                            <input type="text"
                                   class="form-control @error('code') is-invalid @enderror"
                                   id="form-code"
                                   name="code"
                                   value="{{ old('code', $post->code) }}"
                                   placeholder=""
                                   required=""
                            >

                            <div class="invalid-feedback">
                                Code is required.
                            </div>

                            @error('code')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form__field col-6 mb-3">
                            <label for="form-name">Post Name</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="form-name"
                                   name="name"
                                   value="{{ old('name', $post->name) }}"
                                   required=""
                            >

                            <div class="invalid-feedback">
                                Post Name is required.
                            </div>

                            @error('name')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form__field col-6 mb-3">
                            <label for="form-description">Description</label>
                            <input type="text"
                                   class="form-control @error('description') is-invalid @enderror"
                                   id="form-description"
                                   name="description"
                                   value="{{ old('description', $post->description) }}"
                                   required=""
                            >

                            <div class="invalid-feedback">
                                Post Description is required.
                            </div>

                            @error('description')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form__field d-flex flex-column col-12 mb-3">
                            <label for="form-text">Text</label>
                            <textarea name="text"
                                      class="form-control @error('text') is-invalid @enderror"
                                      id="form-text"
                                      cols="30"
                                      rows="10"
                                      placeholder="Post content here"
                                      required="">{{ old('text', $post->text) }}</textarea>

                            <div class="invalid-feedback">
                                Post Description is required.
                            </div>

                            @error('text')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form__field col-6 mb-3">
                            <label for="form-tags">Tags</label>
                            <input type="text"
                                   class="form-control"
                                   id="form-tags"
                                   name="tags"
                                   value="{{ old('tags', $post->tags->pluck('name')->implode(', ')) }}"
                            >
                        </div>

                        <div class="form__field form-check mb-2">
                            <input class="form__checkbox"
                                   id="form-checkbox"
                                   type="checkbox"
                                   name="published"
                                   @if ($post->published) checked @endif
                            >
                            <label class="form-check-label" for="form-checkbox">
                                Published
                            </label>
                        </div>
                    </div>

                    <button class="btn btn-primary align-self-end" type="submit" style="width: 150px">Save changes</button>
                </form>
            </section>
        </div>
    </main>
@endsection

@section('footer')
    @include('layouts.base.footer')
@endsection
