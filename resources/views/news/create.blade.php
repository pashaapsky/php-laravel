@extends('layouts.app')

@section('header')
    @include('layouts.admin.admin-header')
@endsection

@section('content')
    <main class="d-flex py-4" style="min-height: 88vh">
        <div class="container">
            <section class="new-create mb-2">
                <h2 class="new-create__header mb-4"><strong>Creating New</strong></h2>

                <form class="new-create__form form d-flex flex-column needs-validation" method="post" action="{{ route('news.store') }}" novalidate>
                    @csrf

                    <x-NewForm :new="new \App\News()"></x-NewForm>

                    <button class="btn btn-primary align-self-end" type="submit" style="width: 150px">Create</button>
                </form>
            </section>
        </div>
    </main>
@endsection


@section('footer')
    @include('layouts.admin.admin-footer')
@endsection
