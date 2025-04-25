@extends('layouts.layout')

@section('title', 'Франшиза Ledplast')
@section('description',
    'Франшиза Уральского светотехнического завода Ledplast — выгодное предложение для открытия
    бизнеса в сфере светотехнической продукции и электромонтажных работ.')
@section('keywords',
    'франшиза светотехника, франшиза Ledplast, электромонтажные работы франшиза, светодиодные
    светильники франшиза')

@section('body')
    <div class="divider"></div>

    <!-- Hero Section -->
    <div class="hero-section text-center py-5 bg-light">
        <h1 class="display-4 bindigo-text lt-bold lt-up">Франшиза Ledplast</h1>
        <p class="lead bgray-text">Присоединяйтесь к успешному бизнесу под известным брендом</p>
    </div>

    <div class="franchise-container widthing mt-5 mb-5">
        <!-- Главный информационный блок -->
        <div class="row d-flex align-items-start">
            <!-- Левая колонка: Картинка -->
            <div class="col-md-6 mb-3">
                <div class="fixed-image-container left-aligned">
                    <img src="{{ asset('imgs/franchise.jpg') }}" alt="Франшиза Уральского светотехнического завода"
                        class="img-fluid fixed-image">
                </div>
            </div>
            <!-- Правая колонка: Перечисление характеристик -->
            <div class="col-md-6 d-flex flex-column justify-content-start text-aligned-right">
                <p class="bgray-text"><strong>Вид франшизы:</strong> Строительство</p>
                <p class="bgray-text"><strong>Паушальный взнос:</strong> 100 000 ₽</p>
                <p class="bgray-text"><strong>Тип роялти:</strong> Фиксированное</p>
                <p class="bgray-text"><strong>Фиксированное роялти:</strong> 100 000 ₽</p>
                <p class="bgray-text"><strong>Окупаемость:</strong> 3 месяца</p>
                <p class="bgray-text"><strong>Сопровождение:</strong> Есть</p>
                <p class="bgray-text"><strong>Тип сопровождения:</strong> Консультации и сопровождение, помощь в открытии
                </p>
            </div>
        </div>

        <!-- Текстовый блок ниже колонок -->
        <div class="mt-5">
            <h2 class="mb-4 bindigo-text lt-bold lt-up">Что предлагает франшиза Уральского светотехнического завода</h2>
            <p class="bgray-text">Франшиза Уpaльcкогo светотехнического завода позволяет получать доход от прямых низких цен
                на светотехническую продукцию (уличные и промышленные светодиодные светильники) и от электромонтажных работ.
            </p>
            <ul class="mt-3">
                <li class="bgray-text">Поиск электронных торгов по 44-ФЗ и 223-ФЗ</li>
                <li class="bgray-text">Подача заявок на участие в торгах</li>
                <li class="bgray-text">Закупка и поставка материалов для выполнения электромонтажных работ по оптовым ценам
                </li>
                <li class="bgray-text">Подготовка исполнительной документации</li>
                <li class="bgray-text">Обзвон потенциальных клиентов вашего региона</li>
            </ul>
            <p class="mt-4 font-weight-bold bgray-text">По условиям Уральского светотехнического завода в одном регионе
                Российской Федерации может быть представлен только 1 франчайзи. Торопись заключить выгодный договор и
                уверенно работать на масштабном рынке!</p>
        </div>

        <!-- Яндекс карта с адресом -->
        <div class="mt-5">
            <h3 class="bindigo-text lt-bold lt-up">Расположение</h3>
            <div id="map" style="width: 100%; height: 400px;"></div>
        </div>

        <!-- Добавляем скрипты для карты -->
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
        <script type="text/javascript">
            ymaps.ready(function() {
                var myMap = new ymaps.Map('map', {
                    center: [54.734190, 55.933728], // Координаты для Уфы
                    zoom: 17
                });

                var myPlacemark = new ymaps.Placemark([54.734190, 55.933728], {
                    balloonContent: 'Расположение в городе Уфа'
                });

                myMap.geoObjects.add(myPlacemark);
            });
        </script>
        
        
        
    </div>
    <div class="divider"></div>
    @endsection