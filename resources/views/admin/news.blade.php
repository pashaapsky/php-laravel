@extends('layouts.app')

@section('header')
    @include('layouts.admin.admin-header')
@endsection

@section('content')
    @include('layouts.news.news-section')
@endsection

@section('footer')
    @include('layouts.admin.admin-footer')
@endsection
