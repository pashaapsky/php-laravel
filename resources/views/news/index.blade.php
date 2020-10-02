@extends('layouts.app')

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
    <main class="py-4" style="min-height: 88vh">
        <div class="container">
            <section class="news-section news mb-2">
                <h2 class="news__header">News</h2>

                <div class="news-section__news new row flex-wrap">
                    @forelse($news as $new)
                        <div class="new__item d-flex col-md-6 ">
                            <div class="new__heading d-flex flex-column p-3 border rounded mb-4 shadow-sm">
                                <strong class="mb-2 text-primary">new #{{ $new->id }}</strong>

                                <h3 class="new__name mb-0">{{ $new->name }}</h3>

                                <div class="new__created-at mb-1 text-muted">{{ $new->created_at->toFormattedDateString() }}</div>

                                <p class="new__preview card-text flex-grow-1 text-justify">  {{ str_limit($new->text, $limit = 200, $end = '...') }} </p>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('news.show', $new) }}" class="btn btn-outline-secondary" style="width: 80px; font-size: 0.7rem">Read</a>

                                    @if(auth()->user()->hasRole('admin'))
                                        <a href="{{ route('news.edit', $new) }}" class="btn btn-outline-secondary ml-1" style="width: 80px; font-size: 0.7rem">Edit</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                @empty
                    <p class="no-news">No available news yet</p>
                @endforelse
                </div>
            </section>
        </div>
    </main>
@endsection

@section('footer')
    @include('layouts.base.footer')
@endsection
