@extends('layouts.app')

@section('header')
    @include('layouts.admin.admin-header')
@endsection

@section('content')
    <main class="py-4" style="min-height: 88vh">
        <div class="container">
            <div class="intro row">
                @include('layouts.posts.posts-section')
                @include('layouts.aside-tags')
            </div>
        </div>
    </main>
@endsection

@section('footer')
@include('layouts.admin.admin-footer')
@endsection
