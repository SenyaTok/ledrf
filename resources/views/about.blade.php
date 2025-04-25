@extends('layouts.layout')

@section('title', 'О нас - Уральский светотехнический завод')
@section('description',
    'Компания «Ledplast» - Уральский завод светотехнических изделий, является производителем
    светодиодных уличных и промышленных светильников. Узнайте больше о нашей компании, истории и продуктах.')
@section('keywords', 'о нас, светодиодные светильники, уличные светильники, промышленные светильники, Ledplast')
@section('og_title', 'О нас - Уральский светотехнический завод - Ledplast')
@section('og_description',
    'Компания «Ledplast» - Уральский завод светотехнических изделий, является производителем
    светодиодных уличных и промышленных светильников. Узнайте больше о нашей компании, истории и продуктах.')
@section('og_image', asset('imgs/fullestlogo.svg'))

@section('body')
    <div class="divider"></div>

    <div class="widthing">
        <br>
        <br>
        <h3 class="bindigo-text lt-bold lt-up">
            О компании
        </h3>
        <br>
        <p class="bgray-text">
            Компания «Ledplast» - Уральский завод светотехнических изделий, является производителем светодиодных уличных и
            промышленных светильников. «Ledplast» представляет революционную новинку на рынке светодиодных светильников:
            светильники «Ledplast» серии ST и PR, с запатентованной инновационной конструкцией.
            <br>
            <br>
            Современный человек едва ли не большую часть жизни проводит вне дома — на улице, на производстве, в офисах, в
            торговых комплексах, образовательных и медицинских учреждениях. От того, насколько комфортные условия пребывания
            там созданы, зависит его самочувствие, хорошее настроение и результаты труда. Очень важно, чтобы в любом
            помещении, где бы ни находился в течение дня человек, было качественное и правильно подобранное освещение. В
            случае большего заказа, Вы можете получить его в течение 3-5 дней с момента заказа. Вся информация о координатах
            в разделе Контакты.
        </p>
        <br>
        <br>
    </div>
    <div class="about-logo bg-bindigo centering">
        <img src="{{ asset('imgs/fullestlogo.svg') }}" alt="">
    </div>

    <br>

    <div class="divider"></div>

    <br>

    <div class="widthing">
        <h3 class="bindigo-text lt-bold lt-up">
            История компании
        </h3>
    </div>

    <br>

    <div class="history-grid widthing">
        <!-- Линия идет через все элементы -->
        <div class="storyline"></div>

        <!-- Зарождение -->
        <div class="history-item">
            <div class="year-item">
                <h3 class="bgray-text lt-bold lt-up">2013</h3>
            </div>
            <div class="description-item">
                <h3 class="bgray-text lt-bold lt-up">ЗАРОЖДЕНИЕ</h3>
                <p>Зарождение идеи производства светодиодных светильников...</p>
            </div>
        </div>

        <!-- Анализ -->
        <div class="history-item">
            <div class="year-item">
                <h3 class="bgray-text lt-bold lt-up">2015</h3>
            </div>
            <div class="description-item">
                <h3 class="bgray-text lt-bold lt-up">АНАЛИЗ</h3>
                <p>Анализ, изучение направления, первые инженерные разработки и прототипы.</p>
            </div>
        </div>

        <!-- Производство -->
        <div class="history-item">
            <div class="year-item">
                <h3 class="bgray-text lt-bold lt-up">2017</h3>
            </div>
            <div class="description-item">
                <h3 class="bgray-text lt-bold lt-up">ПРОИЗВОДСТВО</h3>
                <p>Производство промышленного светильника, тестирование, ввод в эксплуатацию.</p>
                <h3 class="bgray-text lt-bold lt-up">ДКУ УРАЛ</h3>
                <p>Выпуск серии уличных светодиодных светильников ДКУ УРАЛ.</p>
            </div>
        </div>

        <!-- Признание и рынки -->
        <div class="history-item">
            <div class="year-item">
                <h3 class="bgray-text lt-bold lt-up">2020</h3>
            </div>
            <div class="description-item">
                <h3 class="bgray-text lt-bold lt-up">ПРИЗНАНИЕ</h3>
                <p>Регистрация ООО «Уральский светотехнический завод», сертификация, проведение независимых лабораторных
                    испытаний...</p>
                <h3 class="bgray-text lt-bold lt-up">РЫНКИ</h3>
                <p>Выход на открытый рынок светодиодной светотехнической продукции Российской Федерации, Казахстана,
                    Беларуси.</p>
            </div>
        </div>

        <!-- Светлое будущее -->
        <div class="future">
            <h3 class="bgray-text lt-bold lt-up">Светлое<br>будущее</h3>
        </div>
    </div>


    <div class="divider"></div>
@endsection
