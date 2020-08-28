@extends('layouts.app')

@section('header')
    @include('layouts.admin.admin-header')
@endsection

@section('content')
    <main class="py-4" style="min-height: 88vh">
        <div class="container">
            <section class="feedback-section mb-2">
                <h2 class="feedback-section__header">Feedbacks</h2>

                @if ($feedbacks->count())
                    <table class="table table-info table-bordered table-hover">
                        <thead class="thead-dark">
                        <tr class="" align="center">
                            <th scope="col">ID</th>
                            <th scope="col">Email</th>
                            <th scope="col">Message</th>
                            <th scope="col">Date</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($feedbacks as $id => $feedback)
                            <tr>
                                <th scope="row">{{ $id + 1 }}</th>
                                <td>{{ $feedback->email }}</td>
                                <td class="text-justify">{{ $feedback->text }}</td>
                                <td>{{ $feedback->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="no-posts">Not available feedbacks</p>
                @endif
            </section>
        </div>
    </main>
@endsection

@section('footer')
    @include('layouts.admin.admin-footer')
@endsection
