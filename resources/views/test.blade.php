@extends('layouts.layout')

@section('title', 'Уральский светотехнический завод - Ledplast')


@section('body')
    <h1>Уральский светотехнический завод Ledplast</h1>
    <p class="hide">
        Компания «Ledplast» - Уральский завод светотехнических изделий, производит и поставляет светодиодные уличные и промышленные светильники. «Ledplast» представляет революционные светильники серии ST и PR с инновационной конструкцией.
    </p>
    <div class="cover-wrapper">
        <div class="d-flex flex-column centering">
            <img src="{{ asset('imgs/sitecover.jpg') }}" alt="" class="cover">
        </div>
        <div class="blur centering">
            <div class="logos text-light">
                <div class="fullogo">
                    <img src="{{ asset('imgs/fullogo.svg') }}" alt=""> 
                </div>
                <p>Мы дарим людям свет</p>
            </div>
        </div>
    </div>

    <div class="divider"></div>

    {{-- Микро каталог --}}
    <div class="mini-catalogue">
        <h3 class="bblue-text text-center lt-up lt-bold">
            Большой выбор товаров
        </h3>
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

    <div class="divider"></div>

    <br>

    <div class="widthing d-flex">
        <div class="guy no-matter">
            <img src="imgs/services.png" alt="">
        </div>
        <div class="d-flex flex-column">
            <h3 class="bindigo-text lt-up lt-bold m-2">
                Уcлуги
            </h3>
            <span class="bgray-text m-2">
                Наша компания предоставляет широкий спектр услуг. Составление документации, проведение энергосервисных,
                монтажных и геодезических работ. Ознакомиться с полным списком услуг вы можете на соответствующей
                странице.
            </span>
            <div>
                <a href="{{ route('allServices') }}" class="btn btn-primary text-light bg-bindigo lt-up m-2">
                    К каталогу услуг →
                </a>
                <div class="mini-catalogue-service">
                    <div class="grid-ctlg-service">
                        @foreach ($forServiceGrid as $keyService => $item)
                            <a href="{{ route('allServices', ['category' => $keyService]) }}">
                                @csrf
                                <div class="category-card-service">
                                    <div class="logo-ctg-service bg-bindigo centering">
                                        <img src="{{ asset('imgs/icon_service/' . $keyService . '.svg') }}" alt="">
                                    </div>
                                    <div class="category-name-service bgray-text text-center lt-up">
                                        {!! $item !!}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>

    {{-- Наши работы --}}
    <div class="divider"></div>
    <br>

    <div class="widthing d-flex flex-wrap justify-content-between align-items-center">
        <h3 class="bindigo-text lt-bold lt-up">
            Наши работы
        </h3>

        @auth
            @if (auth()->user()->role < 3)
                <form action="{{ @route('OWnew') }}" method="post">
                    @csrf
                    <button class="btn btn-primary m-2">Добавить проект</button>
                </form>
            @endif
        @endauth
    </div>

    @if (!$ourWorks->isEmpty())
        <div class="widthing d-flex flex-wrap justify-content-between g1">
            @foreach ($ourWorks as $ourWork)
                @php
                    $link = $ourWork->cover === 'default.png' ? 'imgs/default.png' : 'storage/imgs/our_works/covers/' . $ourWork->cover;
                @endphp
                <div class="d-flex flex-wrap flex-direction-column justify-content-center align-items-start ow-state g1">
                    <div class="ow-cover centering">
                        <img src="{{ asset($link) }}" alt="">
                    </div>
                    <div class="d-flex flex-wrap flex-column ow-text">
                        <h4 class="bgray-text lt-bold lt-up">
                            {{ $ourWork->name }}
                        </h4>
                        <div class="bgray-text lt-thin">
                            {{ $ourWork->year }}
                        </div>
                        <br>
                        <div class="bgray-text">
                            {!! mb_strlen($ourWork->description) < 200
                                ? $ourWork->description
                                : mb_substr($ourWork->description, 0, 150) . '...' !!}
                        </div>
                        <br>
                        <a href="{{ route('OWview', ['id' => $ourWork->id]) }}"><button class="btn btn-primary">Подробнее
                                →</button></a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <br>

    {{-- Письма --}}
    <div class="divider"></div>
    <br>

    <div class="widthing d-flex flex-wrap justify-content-between align-items-center">
        <h3 class="lt-bold lt-up bindigo-text">Благодарственные письма</h3>
        @auth
            @if (auth()->user()->role < 3)
                <form action="{{ @route('letterNew') }}" method="post">
                    @csrf
                    <button class="btn btn-primary м-2">Добавить письмо</button>
                </form>
            @endif
        @endauth
    </div>

    <div class="widthing d-flex flex-wrap justify-content-start letters-wrapper">
        @foreach ($letters as $letter)
            <div class="letter-wrapper">
                <a data-fancybox="gallery" data-src="{{ asset('storage/imgs/letter_scans/' . $letter->image) }}" data-caption="Письмо от {{ $letter->from }}">
                    <img src="{{ asset('storage/imgs/letter_scans/' . $letter->image) }}" alt="Письмо от {{ $letter->from }}" title="Письмо от {{ $letter->from }}" class="letter">
                </a>
                @auth
                    @if (auth()->user()->role < 3)
                        <div class="letter-hover d-flex flex-column centering">
                            <form action="{{ route('letterDel', ['id' => $letter->id]) }}" method="post">
                                @csrf
                                <button class="btn btn-danger">Удалить письмо</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        @endforeach
    </div>
    <br>

    {{-- <div class="divider"></div>
    Вакансии
    <br>

    <div class="widthing d-flex ">
        <div class="d-flex flex-column">
            <h3 class="bindigo-text lt-up lt-bold м-2">
                ВАКАНСИИ
            </h3>
            <span class="bgray-text м-2">
                Корпоративная связь, софинансирование абонементов в фитнес – клуб (Leo Fit), система накопления
                персональных дней (1 день в год), отсутствие обязательного dress-code, книжный клуб (библиотека),
                ДМС
                (подбор сети клиник, оптимального корпоративного тарифа) по согласованию, софинансирование авиа- и
                ж/д-билетов в отпуск по РФ по согласованию.
            </span>
            <h3 class="bindigo-text lt-up lt-bold м-2">
                СЕЙЧАС ИЩЕМ:
            </h3>
            <ul class="bgray-text lt-bold wewant м-2">
                <li>Монатжника</li>
                <li>Высотника</ли>
                <ли>Сотника</ли>
                <ли>Прапорщика</ли>
            </ул>
            <бр>
        </div>
        <div class="guy no-matter">
            <img src="imgs/vacancies.png" alt="">
        </div>
    </div> --}}
@endsection