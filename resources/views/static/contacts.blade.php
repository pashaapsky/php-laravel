@extends('layouts.app')

@section('header')
    @include('layouts.base.header')
@endsection

@section('content')
    <main class="py-4" style="min-height: 88vh">
        <div class="container">
            <section class="contacts-section mb-2">
                <h2 class="contacts-section__header">Contacts</h2>

                <ul class="contacts-section__contacts contact border rounded d-flex flex-row flex-wrap p-0">
                    <li class="contact__item list-group-item border col-md-6">
                        <div class="contacts__body">
                            <div class="contact__name">
                                @admin
                            </div>

                            <div class="contact__phone">
                                <a href="tel:+7(499)995-77-55">+7 (499) 995-77-55</a>
                            </div>

                            <div class="contact__phone">
                                <a href="mailto:admin@mail.ru">admin@mail.ru</a>
                            </div>
                        </div>
                    </li>

                    <li class="contact__item list-group-item border col-md-6">
                        <div class="contacts__body">
                            <div class="contact__name">
                                @admin
                            </div>

                            <div class="contact__phone">
                                <a href="tel:+7(499)995-77-55">+7 (499) 995-77-55</a>
                            </div>

                            <div class="contact__phone">
                                <a href="mailto:admin@mail.ru">admin@mail.ru</a>
                            </div>
                        </div>
                    </li>

                    <li class="contact__item list-group-item border col-md-6">
                        <div class="contacts__body">
                            <div class="contact__name">
                                @admin
                            </div>

                            <div class="contact__phone">
                                <a href="tel:+7(499)995-77-55">+7 (499) 995-77-55</a>
                            </div>

                            <div class="contact__phone">
                                <a href="mailto:admin@mail.ru">admin@mail.ru</a>
                            </div>
                        </div>
                    </li>

                    <li class="contact__item list-group-item border col-md-6">
                        <div class="contacts__body">
                            <div class="contact__name">
                                @admin
                            </div>

                            <div class="contact__phone">
                                <a href="tel:+7(499)995-77-55">+7 (499) 995-77-55</a>
                            </div>

                            <div class="contact__phone">
                                <a href="mailto:admin@mail.ru">admin@mail.ru</a>
                            </div>
                        </div>
                    </li>
                </ul>

                <div class="feedback">
                    <h4 class="feedback__header text-danger">Leave feedback</h4>

                    <form class="feedback__form form d-flex flex-column needs-validation" method="post" action="/admin/feedbacks" novalidate>
                        @csrf

                        <div class="form__fields d-flex border rounded shadow-sm bg-white flex-column p-2 mb-3">
                            <div class="form__field col-12 mb-3">
                                <label for="form-email"><strong>Your email</strong></label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="form-email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       placeholder="@email"
                                       required=""
                                       style="max-width: 300px"
                                >

                                <div class="invalid-feedback">
                                    Email is required.
                                </div>

                                @error('email')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form__field col-12 mb-3">
                                <label for="form-textarea"><strong>Feedback text</strong></label>
                                <textarea name="text"
                                          id="form-textarea"
                                          class="form-control @error('text') is-invalid @enderror"
                                          cols="30" rows="7"
                                          placeholder=""
                                          required>{{ old('text') }}</textarea>

                                <div class="invalid-feedback">
                                    Text is required.
                                </div>

                                @error('text')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <button class="btn btn-primary align-self-start" type="submit" style="width: 150px">Send feedback</button>
                    </form>
                </div>
            </section>
        </div>
    </main>
@endsection

@section('footer')
    @include('layouts.base.footer')
@endsection
