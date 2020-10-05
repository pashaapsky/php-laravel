@extends('layouts.app')

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
    <div class="container">
        <section class="new-show my-3 d-flex flex-column">
            <h2 class="new-show header text-primary"><strong>New #{{ $news->id }}</strong></h2>

            <div class="new-show__content new d-flex flex-column">
                <div class="new__intro d-flex w-100 border no-gutters rounded mb-4 shadow-sm position-relative">
                    <div class="new__heading col-6 p-3 d-flex flex-column justify-content-top position-static">
                        <h4 class="new__name mb-2">Name : {{ $news->name }}</h4>

                        <div class="new__created-at mb-2 text-muted">Created at :
                            {{ $news->created_at->toFormattedDateString() }}
                        </div>
                    </div>
                </div>

                <div class="new__text mb-3">
                    <h3 class="new__heading ml-3">Text</h3>

                    <p class="card-text mb-auto p-3 text-justify border rounded shadow-sm" style="min-height: 60vh"> {{ $news->text }} </p>
                </div>

                @if(auth()->user()->hasRole('admin'))
                    <a href="/news/{{ $news->id }}/edit" class="btn btn-primary align-self-end">Edit new</a>
                @endif
            </div>
        </section>
    </div>
@endsection

@section('footer')
    @include('layouts.base.footer')
@endsection
