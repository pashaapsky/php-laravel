@extends('layouts.app')

@section('header')
    @include('layouts.admin.admin-header')
@endsection

@section('content')
    <main class="d-flex py-4" style="min-height: 88vh">
        <div class="container">
            <section class="new-edit mb-2">
                <h2 class="new-edit__header mb-4"><strong>Edit new #{{ $new->id }}</strong></h2>

                <form class="new-edit__form form d-flex flex-column needs-validation" method="post" action="{{ route('news.update', $new) }}" novalidate>
                    @csrf
                    @method('patch')

                    <x-NewForm :new="$new"></x-NewForm>

                    <button class="btn btn-primary align-self-end" type="submit" style="width: 150px">Save changes</button>
                </form>
            </section>
        </div>
    </main>
@endsection

@section('footer')
    @include('layouts.admin.admin-footer')
@endsection
