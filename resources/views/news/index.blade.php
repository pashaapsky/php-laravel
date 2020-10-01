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

                                <p class="new__preview card-text flex-grow-1 text-justify">  {{ str_limit($new->text, $limit = 100, $end = '...') }} </p>
                            </div>

{{--                                <div class="d-flex col-12 justify-content-end pr-2">--}}
{{--                                    <a href="/news/{{ $new->id }}/edit" class="btn btn-outline-secondary" style="width: 80px; font-size: 0.7rem">Edit</a>--}}

{{--                                    <form method="new" action="{{ route('news.destroy', $new) }}">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                        <button type="submit" class="btn btn-outline-secondary" style="width: 80px; font-size: 0.7rem">Delete</button>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
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
