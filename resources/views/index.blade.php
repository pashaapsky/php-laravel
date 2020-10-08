@extends('layouts.app')

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
    <main class="py-4" style="min-height: 88vh">
        <div class="container">
            <div class="intro row">
                <div class="sections col-sm-8 col-lg-10 order-2 order-sm-0">
                    <div class="sections__items row">
                        <section class="posts-section col-12 col-lg-8 mb-2">
                            <h3 class="posts-section__header text-center">Latest posts</h3>

                            @include('layouts.posts.posts-items')
                        </section>

                        <section class="news-section col-12 col-lg-4 mb-2">
                            <h3 class="news-section__header text-center">Latest News</h3>

                            @include('layouts.news.news-items')
                        </section>
                    </div>
                </div>

                @include('layouts.aside-tags')
            </div>
        </div>
    </main>
@endsection

@section('footer')
    @include('layouts.base.footer')
@endsection
