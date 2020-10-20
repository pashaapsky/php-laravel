@extends('layouts.app')

@section('header')
    @include('layouts.admin.admin-header')
@endsection

@section('content')
    <main class="py-4" style="min-height: 88vh">
        <div class="container">
            <div class="intro row">
                <section class="news-section mb-2 flex-column col-12 col-sm-8 col-lg-10 order-2 order-sm-0">
                    <h3 class="news-section__header col-12 text-center">News</h3>

                    @include('layouts.news.news-items')
                </section>

                @include('layouts.aside-tags')
            </div>
        </div>
    </main>
@endsection

@section('footer')
    @include('layouts.admin.admin-footer')
@endsection
