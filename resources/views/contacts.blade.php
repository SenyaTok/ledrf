@extends('layouts.layout')

@section('title', 'Контакты - Уральский светотехнический завод')
@section('description', 'Контактная информация компании «Ledplast». Узнайте, как связаться с нами, адрес, режим работы и другую важную информацию.')
@section('keywords', 'контакты, светодиодные светильники, уличные светильники, промышленные светильники, Ledplast')
@section('og_title', 'Контакты - Уральский светотехнический завод - Ledplast')
@section('og_description', 'Контактная информация компании «Ledplast». Узнайте, как связаться с нами, адрес, режим работы и другую важную информацию.')
@section('og_image', asset('imgs/office-building_2086058.svg'))

@section('body')
    <div class="divider"></div>

    <br>
    <br>

    <div class="widthing">
        <h3 class="bindigo-text lt-bold lt-up">
            Контакты
        </h3>

        <br>

        <h3 class="bgray-text lt-bold lt-up">
            Отправить сообщение
        </h3>

        <p class="abzac">
            Поделитесь своими идеями или пожеланиями по работе нашего магазина. Остались ли вы довольны заказом или есть какие-то замечания. Мы будем рады получить от вас пару строк.
        </p>
    </div>

    <br>
    <br>

    <div class="widthing d-flex flex-wrap justify-content-around">
        <div class="d-flex flex-wrap flex-column centering">
            <img src="{{ asset('imgs/office-building_2086058.svg') }}" alt="" class="contact-img">
            <p class="contact-text">г. Уфа, ул. Красина, д. 21</p>
        </div>
        <div class="d-flex flex-wrap flex-column centering">
            <img src="{{ asset('imgs/clock_992700.svg') }}" alt="" class="contact-img">
            <p class="contact-text">Пн-Вс: 10.00 - 19.00</p>
        </div>
        <div class="d-flex flex-wrap flex-column centering">
            <img src="{{ asset('imgs/telephone_159832.svg') }}" alt="" class="contact-img">
            <p class="contact-text">+7 (347) 266 06-78</p>
        </div>
        <div class="d-flex flex-wrap flex-column centering">
            <img src="{{ asset('imgs/email_2787620.svg') }}" alt="" class="contact-img">
            <p class="contact-text">info@ledplast.ru</p>
        </div>
    </div>

    <br>
    <br>

    <div class="divider"></div>

    <br>
    <br>

    <div class="widthing d-flex flex-wrap flex-wrap align-items-center justify-content-between">
        <div>
            <h3 class="bgray-text lt-bold lt-up">
                Мы в соцсетях
            </h3>

            <p class="abzac">
                Вы также можете следить за нами на страницах в наших социальных сетях!
            </p>
        </div>

        <div class="ftr-soc-links lt-thin">
            <a href=""><img src="{{ asset('imgs/VK2.svg') }}" alt=""></a>
            <a href=""><img src="{{ asset('imgs/YouTube.svg') }}" alt=""></a>
            <a href=""><img src="{{ asset('imgs/TikTok2.svg') }}" alt=""></a>
        </div>
    </div>

    <br>
    <br>

    <div class="divider"></div>
@endsection