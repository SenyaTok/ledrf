@extends('layouts.layout')

@section('title')
    {{ $product->name }}
@endsection

@php
    switch ($product->ProductMedia()->count()) {
        case 0:
            $link = 'imgs/default.png';
            break;
        case 1:
            $link = 'storage/imgs/products/' . $product->cover;
            break;
        default:
            break;
    }
    $link = $product->ProductMedia()->count() === 0 ? 'imgs/default.png' : 'storage/imgs/products/' . $product->cover;
    $active = ' active';
@endphp

@section('body')
    <div class="divider"></div>

    @auth
        @if (auth()->user()->role < 3)
            <br>
            <div class="d-flex flex-wrap centering">
                <form action="{{ @route('productEdit', ['id' => $product->id]) }}" method="post">
                    @csrf
                    <button class="btn btn-secondary m-2">Редактировать товар</button>
                </form>
                <form action="{{ @route('productDelete', ['id' => $product->id]) }}" method="post">
                    @csrf
                    <button class="btn btn-danger m-2">Удалить товар</button>
                </form>
            </div>
            <br>
            <div class="divider"></div>
        @endif
    @endauth
    <br>
    <br>

    <div class="widthing">
        <div class="d-flex flex-wrap about-product flex-wrap centering justify-content-around">
            @if ($link)
                <div class="product-cover m-2 d-flex align-items-center justify-content-center">
                    <img src="{{ asset($link) }}" alt="Изображение продукта">
                </div>
            @endif
            <div class="product-text d-flex flex-wrap flex-column m-2">
                <h3 class="lt-bold lt-up bindigo-text">{{ $product->name }}</h3>

                @auth
                    <form action="{{ @route('addToCart', ['id' => $product->id]) }}" method="post">
                        @csrf
                        <button class="btn btn-primary m-2">Добавить в корзину</button>
                    </form>
                @endauth

                <div class="accordion" id="accordionExample">
                    @if ($product->description != null)
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" 
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        О товаре
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    {!! $product->description !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($product->advantages != null)
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" 
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Преимущества
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    {!! $product->advantages !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($product->usability != null)
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" 
                                        data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Применение
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    {!! $product->usability !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($product->parameters != null)
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" 
                                        data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Характеристики
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                <div class="card-body">
                                    {!! $product->parameters !!}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <br>

<!-- Блок с моделью, без границы, прижат к левому краю -->
<div class="d-flex justify-content-center">
    <div class="w-75 p-0">
        <div class="mb-3">
            <h4 class="m-0 pl-0"><strong>Модели товара:</strong></h4> <!-- Впритык к левому краю -->
        </div>
        <div class="row ml-0">
            @php
                $model_lines = preg_split('/\r\n|\r|\n/', strip_tags(html_entity_decode($product->model ?? 'Не указана')));
                $chunked_lines = array_chunk($model_lines, 10); // Разбиваем на блоки по 10 строк
            @endphp

            @foreach ($chunked_lines as $index => $chunk)
                <div class="col-md-6 p-0 pr-5"> <!-- Добавил правый отступ -->
                    @foreach ($chunk as $line)
                        <p class="m-0 pl-0 mb-2" style="font-size: 14px;">{{ trim($line) }}</p>
                    @endforeach
                    <hr class="mt-3"> <!-- Отступ перед чертой, чтобы не сливались -->
                </div>

                @if (($index + 1) % 2 == 0) <!-- Закрываем строку и начинаем новую после каждых двух столбцов -->
                    </div><div class="row ml-0">
                @endif
            @endforeach
        </div>
    </div>
</div>
    <br>
    <div class="divider"></div>
    <br>

    <div class="widthing">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                @foreach ($product->productMedia as $productMedia)
                    <div class="carousel-item{{ $active }}">
                        <div class="carousel-item-iwrapper">
                            <img class="d-block w-100" src="{{ asset('storage/imgs/products/' . $productMedia->image) }}"
                                alt="{{ $productMedia->image }}">
                        </div>
                    </div>
                    @php
                        $active = null;
                    @endphp
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <br>

@endsection