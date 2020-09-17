@extends('layouts.app')

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
    <main class="d-flex py-4" style="min-height: 88vh">
        <div class="container">
            <section class="post-create mb-2">
                <h2 class="post-create__header mb-4"><strong>Creating new post</strong></h2>

                <form class="post-create__form form d-flex flex-column needs-validation" method="post" action="{{ route('posts.store') }}" novalidate>
                    @csrf

                    <x-PostForm></x-PostForm>

                    <button class="btn btn-primary align-self-end" type="submit" style="width: 150px">Submit form</button>
                </form>
            </section>
        </div>
    </main>
@endsection


@section('footer')
    @include('layouts.base.footer')
@endsection
