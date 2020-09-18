@extends('layouts.app')

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
    <main class="d-flex py-4" style="min-height: 88vh">
        <div class="container">
            <section class="post-edit mb-2">
                <h2 class="post-edit__header mb-4"><strong>Edit post #{{ $post->id }}</strong></h2>

                <form class="post-edit__form form d-flex flex-column needs-validation" method="post" action="{{ route('posts.update', $post) }}" novalidate>
                    @csrf
                    @method('patch')

                    <x-PostForm :post="$post"></x-PostForm>

                    <button class="btn btn-primary align-self-end" type="submit" style="width: 150px">Save changes</button>
                </form>
            </section>
        </div>
    </main>
@endsection

@section('footer')
    @include('layouts.base.footer')
@endsection
