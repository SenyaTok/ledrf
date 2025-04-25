@extends('layouts.layout')

@section('title', $data['title'] . ' - Каталог товаров - Уральский светотехнический завод')
@section('description', 'Просмотрите каталог товаров компании «Ledplast», включая светодиодные уличные и промышленные светильники. Узнайте больше о наших продуктах.')
@section('keywords', 'каталог товаров, уличные светильники, промышленные светильники, офисные светильники, парковые опоры (светильники), кронштейны и закладные, АСУНО, светофорные комплексы, мобильное освещение, архитектурная подсветка, Ledplast')
@section('og_title', $data['title'] . ' - Каталог товаров - Уральский светотехнический завод - Ledplast')
@section('og_description', 'Просмотрите каталог товаров компании «Ledplast», включая светодиодные уличные и промышленные светильники. Узнайте больше о наших продуктах.')
@section('og_image', asset('imgs/default.png'))

@php
    $products = $data['products'];
    $types = $data['types'];

    $forGrid = [
        '1' => 'Уличные светильники',
        'Промышленные светильники',
        'Офисные светильники',
        'Парковые опоры (светильники)',
        'Кронштейны и закладные',
        'Асуно, it-разработка ПО',
        'Светофорные комплексы',
        'Мобильное освещение',
        'Архитектурная подсветка',
    ];
@endphp

@section('body')
    <div class="divider"></div>

    <br>
    <br>

    <div class="widthing d-flex flex-wrap justify-content-between align-items-center">
        <div>
            <h3 class="lt-bold lt-up bindigo-text">Каталог товаров</h3>
            <p class="lt-thin italic bgray-text this-catalogue" title="{{ $data['title'] }}">
                {{ mb_strlen($data['title']) > 45 ? mb_substr($data['title'], 0, 45) . '...' : $data['title'] }}
            </p>
        </div>
        @auth
            @if (auth()->user()->role < 2)
                <form action="{{ @route('productNew') }}" method="post">
                    @csrf
                    <button class="btn btn-primary m-2 rounded">Новый товар</button>
                </form>
            @endif
        @endauth
        <button type="button" class="btn btn-secondary m-2 rounded" data-toggle="modal" data-target="#exampleModal">
            Фильтры
        </button>
    </div>

    <div class="mini-catalogue">
        <div class="grid-ctlg">
            @foreach ($forGrid as $key => $item)
                <a href="{{ route('shop', ['category' => $key]) }}">
                    @csrf
                    <div class="category-card">
                        <div class="logo-ctg bg-bindigo centering">
                            <img src="{{ asset('imgs/logos/' . $key . '.svg') }}" alt="">
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
                <form class="modal-content" method="GET" action="{{ route('shop') }}">
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
                            <option value="cost">По цене</option>
                            <option value="created_at">По дате добавления</option>
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

    <div class="divider"></div>
    <br>
    <br>
    <div class="widthing d-flex flex-wrap justify-content-between align-items-center">
        <h3 class="lt-bold lt-up bindigo-text">Товары по вашему запросу</h3>
        <span class="bgray-text m-2">Всего позиций: {{ $data['count'] }}</span>
    </div>
    <br>
    <div class="pcards-wrapper widthing" id="catalogue">
        @foreach ($products as $product)
            @php
                $link = $product->ProductMedia()->count() === 0 ? 'imgs/default.png' : 'storage/imgs/products/' . $product->cover;
            @endphp
            <div class="product-card">
                <div class="pcard-cover centering">
                    <img src="{{ asset($link) }}" alt="">
                </div>
                <div class="pcard-text">
                    <a href="{{ route('seeProduct', ['id' => $product->id]) }}">
                        <h5 class="bindigo-text lt-bold" title="{{ $product->name }}">
                            {{ mb_strlen($product->name) > 40 ? mb_substr($product->name, 0, 40) . '...' : $product->name }}
                        </h5>
                    </a>
                    <p class="product-category black-text">{{ $product->category }}</p>
                    <a href="{{ route('seeProduct', ['id' => $product->id]) }}" class="btn btn-outline-primary rounded">Подробнее</a>
                </div>
            </div>
        @endforeach
    </div>
    <br>
    <br>
    <div class="divider"></div>
@endsection
