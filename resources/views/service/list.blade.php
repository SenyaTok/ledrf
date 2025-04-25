@extends('layouts.layout')

@section('title', $data['title'] . ' - Каталог услуг - Уральский светотехнический завод')
@section('description', 'Просмотрите каталог услуг компании «Ledplast», включая составление сметной документации, монтаж
    светильников и многое другое. Узнайте больше о наших услугах.')
@section('keywords', 'каталог услуг, составление сметной документации, составление проектной документации, прохождение
    государственной экспертизы, монтаж светильников, монтаж опор освещения, монтаж сип кабеля, подготовка светотехнического
    расчета, проведение геодезических изысканий, проведение энергоаудита (обследование), Ledplast')
@section('og_title', $data['title'] . ' - Каталог услуг - Уральский светотехнический завод - Ledplast')
@section('og_description', 'Просмотрите каталог услуг компании «Ledplast», включая составление сметной документации,
    монтаж светильников и многое другое. Узнайте больше о наших услугах.')
@section('og_image', asset('imgs/default.png'))

@php
    $services = $data['services'];
    $types = $data['types'];
    $isCategorySelected = request()->has('category'); // Проверяем, выбрана ли категория

    $forServiceGrid = [
        '1' => 'Составление сметной документации',
        'Составление проектной документации',
        'Прохождение государственной экспертизы',
        'Монтаж светильников',
        'Монтаж опор освещения',
        'Монтаж СИП кабеля',
        'Подготовка светотехнического расчета',
        'Проведение геодезических изысканий',
        'Проведение энергоаудита (обследование)',
    ];
@endphp

@section('body')
    <div class="divider"></div>

    <br>
    <br>

    <div class="widthing d-flex flex-wrap justify-content-between align-items-center">
        <div>
            <h3 class="lt-bold lt-up bindigo-text">Каталог услуг</h3>
            <p class="lt-thin italic bgray-text this-catalogue" title="{{ $data['title'] }}">
                {{ mb_strlen($data['title']) > 45 ? mb_substr($data['title'], 0, 45) . '...' : $data['title'] }}
            </p>
        </div>
        @auth
            @if (auth()->user()->role < 2)
                <form action="{{ route('serviceNew') }}" method="get">
                    @csrf
                    <button class="btn btn-primary m-2 rounded">Новая услуга</button>
                </form>
            @endif
        @endauth
        {{-- <button type="button" class="btn btn-secondary m-2 rounded" data-toggle="modal" data-target="#exampleModal">
            Фильтры
        </button> --}}
    </div>

    <div class="mini-catalogue">
        <div class="grid-ctlg">
            @foreach ($forServiceGrid as $key => $item)
                <a href="{{ route('allServices', ['category' => $key]) }}">
                    @csrf
                    <div class="category-card">
                        <div class="logo-ctg bg-bindigo centering">
                            <img src="{{ asset('imgs/icon_service/' . $key . '.svg') }}" alt="">
                        </div>
                        <div class="category-name bgray-text text-center lt-up">
                            {!! $item !!}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <br>

    <div class="d-flex flex-wrap">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form class="modal-content" method="GET" action="{{ route('allServices') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title lt-bold lt-up bindigo-text" id="exampleModalLabel">Фильтрация</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @foreach ($types as $type)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="type{{ $type['id'] }}"
                                    name="{{ $type['id'] }}" value="option1">
                                <label class="form-check-label" for="type{{ $type['id'] }}">{{ $type['name'] }}</label>
                            </div>
                        @endforeach
                        <br>
                        <select name="order_by" id="">
                            <option value="created_at">По дате добавления</option>
                            <option value="name">По имени</option>
                        </select>
                        <select name="sequence" id="">
                            <option value="desc">Убывание</option>
                            <option value="asc">Возрастание</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button class="btn btn-primary">Применить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($isCategorySelected)
        <div class="divider"></div>

        <br>
        <br>

        <div class="widthing">
            <div class="d-flex flex-wrap about-product flex-wrap centering justify-content-around">
                @foreach ($services as $service)
                    @php
                        $link = $service->link ?? 'imgs/default.png'; // Использование переменной $link с проверкой
                    @endphp
                    @if ($link)
                        <div class="product-cover m-2 d-flex align-items-center justify-content-center">
                            <img src="{{ asset($link) }}" alt="Изображение услуги">
                        </div>
                    @endif
                    <div class="product-text d-flex flex-wrap flex-column m-2">
                        <h3 class="lt-bold lt-up bindigo-text">{{ $service->name }}</h3>

                        @if ($service->description != null)
                            <span class="m-2">{!! $service->description !!}</span>
                        @endif

                        {{-- Блок для редактирования и удаления услуги только для авторизованных пользователей с ролью < 3 --}}
                        @auth
                            @if (auth()->user()->role < 3)
                                <br>
                                <div class="d-flex flex-wrap centering">
                                    <form action="{{ route('serviceEdit', ['id' => $service->id]) }}" method="get">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary">Редактировать услугу</button>
                                    </form>
                                    <form action="{{ route('serviceDelete', ['id' => $service->id]) }}" method="post">
                                        @csrf
                                        <button class="btn btn-danger m-2">Удалить услугу</button>
                                    </form>
                                </div>
                                <br>
                            @endif
                        @endauth
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <br>
    <br>

    <div class="divider"></div>

    <div class="widthing"></div>
@endsection
