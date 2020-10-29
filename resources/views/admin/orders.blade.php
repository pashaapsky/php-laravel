@extends('layouts.app')

@section('header')
    @include('layouts.admin.admin-header')
@endsection

@section('content')
    <main class="py-4" style="min-height: 88vh">
        <div class="container">
            <div class="intro">
                <section class="orders-section mb-2 flex-column">
                    <h3 class="orders-section__header text-center">Orders</h3>

                    <ul class="orders-section__orders order list-group">
                        <li class="order__item d-flex flex-column list-group-item">
                            <h4 class="order__heading mb-3">
                                <button class="btn btn-link" style="font-size: 2rem; outline: none" data-toggle="collapse" data-target="#order-all" aria-expanded="false" aria-controls="order-all">
                                    Итоговый отчет
                                </button>
                            </h4>

                            <form class="collapse p-3 border" id="order-all" method="post" action="{{ route('admin.orders') }}" novalidate>
                                @csrf

                                <span class="d-block w-25 mb-2">Выберите что включить в отчет:</span>

                                <label class="d-block w-25"><input class="" type="checkbox" name="news" id="news"> Новости</label>

                                <label class="d-block w-25"><input class="" type="checkbox" name="posts" id="posts"> Статьи</label>

                                <label class="d-block w-25"><input class="" type="checkbox" name="comments" id="comments"> Комментарии</label>

                                <label class="d-block w-25"><input class="" type="checkbox" name="tags" id="tags"> Теги</label>

                                <label class="d-block w-25"><input class="" type="checkbox" name="users" id="users"> Пользователи</label>

                                <button class="btn btn-success" type="submit">Сформировать отчет</button>
                            </form>
                        </li>

                        <li class="order__item d-flex flex-column list-group-item">
                            <h4 class="order__heading mb-3">
                                <button class="btn btn-link" style="font-size: 2rem; outline: none" data-toggle="collapse" data-target="" aria-expanded="false" aria-controls="">
                                    Другой отчет
                                </button>
                            </h4>
                        </li>
                    </ul>
                </section>
            </div>
        </div>
    </main>
@endsection

@section('footer')
    @include('layouts.admin.admin-footer')
@endsection
