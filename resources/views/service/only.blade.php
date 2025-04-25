@extends('layouts.layout')

@section('title')
    {{ $service->name }}
@endsection

@php
    switch ($service->serviceMedia()->count()) {
        case 0:
            $link = 'imgs/default.png';
            break;
        case 1:
            $link = 'storage/imgs/services/' . $service->cover;
            break;

        default:
            break;
    }
    $link = $service->serviceMedia()->count() === 0 ? 'imgs/default.png' : 'storage/imgs/services/' . $service->cover;
    $active = ' active';
@endphp

@section('body')
    <div class="divider"></div>

    @auth
        @if (auth()->user()->role < 3)
            <br>
            <div class="d-flex flex-wrap centering">
                <form action="{{ route('serviceEdit', ['id' => $service->id]) }}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Редактировать услугу</button>
                </form>
                <form action="{{ @route('serviceDelete', ['id' => $service->id]) }}" method="post">
                    @csrf
                    <button class="btn btn-danger m-2">Удалить услугу</button>
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
                    <img src="{{ asset($link) }}" alt="Изображение услуги">
                </div>
            @endif
            <div class="product-text d-flex flex-wrap flex-column m-2">
                <h3 class="lt-bold lt-up bindigo-text">{{ $service->name }}</h3>

                @if ($service->description != null)
                    <span class="m-2">{!! $service->description !!}</span>
                @endif
            </div>
        </div>
    </div>

    <br>
    <br>
    <div class="divider"></div>
    {{-- <br>
    <br>
    <div class="widthing">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                @foreach ($service->serviceMedia as $serviceMedia)
                    <div class="carousel-item{{ $active }}">
                        <div class="carousel-item-iwrapper">
                            <img class="d-block w-100" src="{{ asset('storage/imgs/services/' . $serviceMedia->image) }}"
                                alt="{{ $serviceMedia->image }}">
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
    <br> --}}
@endsection
