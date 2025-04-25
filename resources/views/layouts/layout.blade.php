<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ledplast - @yield('title', 'Default Title')</title>
    <meta name="description" content="@yield('description', 'Уральский светотехнический завод Ledplast предлагает широкий ассортимент светодиодных уличных и промышленных светильников. Высокое качество и надежность.')">
    <meta name="keywords" content="@yield('keywords', 'уличные светильники, промышленные светильники, офисные светильники, парковые опоры (светильники), кронштейны и закладные, составление сметной документации, составление проектной документации, прохождение государственной экспертизы, монтаж светильников, монтаж опор освещения,  Ledplast')">

    <!-- Canonical tag -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph tags for better social media integration -->
    <meta property="og:title" content="@yield('og_title', 'Ledplast - Уральский светотехнический завод')" />
    <meta property="og:description" content="@yield('og_description', 'Уральский светотехнический завод Ledplast предлагает широкий ассортимент светодиодных уличных и промышленных светильников. Высокое качество и надежность.')" />
    <meta property="og:image" content="@yield('og_image', asset('imgs/logo_local.svg'))" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />

    <!-- Yandex and Google meta tags -->
    <meta name="yandex-verification" content="your-yandex-verification-code" />
    <meta name="google-site-verification" content="your-google-verification-code" />

    <!-- General meta tags -->
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" href="{{ asset('imgs/logo_local.svg') }}" type="image/x-icon">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <!-- Fancybox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <!-- TineMCE -->
    <script src="https://cdn.tiny.cloud/1/4hbyymp0f74cv8jv9slciugbzft84513tu8njm4olrn91p26/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '.tinyMCE',
            language: 'ru',
            menubar: 'edit format insert view',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>

    <!-- Local CSS -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            for (var j = 0; j < document.scripts.length; j++) {
                if (document.scripts[j].src === r) {
                    return;
                }
            }
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(
                k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(98528042, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/98528042" style="position:absolute; left:-9999px;" alt="" />
        </div>
    </noscript>
    <!-- /Yandex.Metrika counter -->

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-bindigo lt-thin sticky-top">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('imgs/logo.svg') }}" alt="Логотип" class="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ @route('home') }}">Главная</a>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">
                        Каталог
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item text-white hov-gray" href="{{ route('shop') }}">Товары</a>
                        <a class="dropdown-item text-white hov-gray" href="{{ route('allServices') }}">Услуги</a>
                    </div>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">
                        Статьи
                    </a>
                    <div class="dropdown-menu active">
                        <a class="dropdown-item text-white hov-gray" href="{{ @route('delivery') }}">Доставка</a>
                        <a class="dropdown-item text-white hov-gray"
                            href="{{ @route('viewPosts', ['ptype' => 'Госучреждениям']) }}">Госучреждениям</a>
                        <a class="dropdown-item text-white hov-gray"
                            href="{{ @route('viewPosts', ['ptype' => 'Полезная информация']) }}">Полезная
                            информация</a>
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ @route('about') }}">О нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ @route('vakansii') }}">Вакансии</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ @route('franchise') }}">Франшиза</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ @route('contacts') }}">Контакты</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ @route('auth') }}">Вход</a>
                    </li>
                @endguest
                @auth

                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Пользователь
                        </a>
                        <div class="dropdown-menu active">
                            @if (auth()->user()->role === 1)
                                <a class="dropdown-item text-white hov-gray"
                                    href="{{ @route('usrRedaction') }}">Администрирование</a>
                            @endif
                            @if (auth()->user()->role < 3)
                                {{-- <a class="dropdown-item text-white hov-gray" href="{{ @route('viewPosts', ['ptype' => 'Черновик']) }}">Черновики</a> --}}
                            @endif
                            <a class="dropdown-item text-white hov-gray" href="{{ @route('cart') }}">Корзина</a>
                            <a class="dropdown-item text-white hov-gray" href="{{ @route('user') }}">Личный кабинет</a>
                            <form action="{{ @route('logout') }}" method="POST">
                                @csrf
                                <button class="lt-thin bg-bindigo border-0 dropdown-item text-white hov-gray"
                                    href="#">Выход</button>
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    @yield('body')

    <footer class="bg-bindigo lt-thin mt-auto">
        <div class="ftr-wrapper widthing">

            <!-- Левая часть с логотипом и информацией -->
            <div class="ftr-left-container">
                <div class="ftr-logo">
                    <img src="{{ asset('imgs/fullestlogo.svg') }}" alt="Ledplast">
                </div>
                <div class="ftr-info">
                    <div class="list m-2">
                        <div class="l-point lt-bold">
                            <p>Сервисы</p>
                        </div>
                        <div class="l-point lt-thin">
                            <a href="{{ route('shop') }}">Товары</a>
                        </div>
                        <div class="l-point lt-thin">
                            <a href="{{ route('allServices') }}">Услуги</a>
                        </div>
                        <div class="l-point lt-thin">
                            <a href="">Электромонтаж</a>
                        </div>
                        <div class="l-point lt-thin">
                            <a href="">АСУНО</a>
                        </div>
                    </div>
                    <div class="list m-2">
                        <div class="l-point lt-bold">
                            <p>Статьи</p>
                        </div>
                        <div class="l-point lt-thin">
                            <a href="">Государственным учреждениям</a>
                        </div>
                        <div class="l-point lt-thin">
                            <a href="">Полезная информация</a>
                        </div>
                        <div class="l-point lt-thin">
                            <a href="">Наши работы</a>
                        </div>
                    </div>
                    <div class="list m-2">
                        <div class="l-point lt-bold">
                            <p>О нас</p>
                        </div>
                        <div class="l-point lt-thin">
                            <a href="{{ route('vakansii') }}">Вакансии</a>
                        </div>
                        <div class="l-point lt-thin">
                            <a href="{{ route('contacts') }}">Контакты</a>
                        </div>
                        <div class="l-point lt-thin">
                            <a href="{{ route('about') }}">История компании</a>
                        </div>
                        <div class="l-point lt-thin">
                            <a href="{{ route('franchise') }}">Франшиза</a>
                        </div>
                    </div>
                    <div class="ftr-office-info m-2">
                        <div class="l-point lt-bold">
                            <p>Контактная информация</p>
                        </div>
                        <p>г. Уфа, ул. Красина, д. 21</p>
                        <p>+7 347 266 06 78</p>
                        <p>info@ledplast.ru</p>
                        <p>ООО “Уральский светотехнический завод”, 2024</p>
                        <div class="ftr-soc-links lt-thin">
                            <!-- WhatsApp Link -->
                            <a href="https://wa.me/73472660678" target="_blank" class="social-link">
                                <img src="{{ asset('imgs/whatsapp-logo.svg') }}" alt="WhatsApp">
                                <span>WhatsApp</span>
                            </a>
                            <!-- Telegram Link -->
                            <a href="https://t.me/Albina_LED" target="_blank" class="social-link">
                                <img src="{{ asset('imgs/telegram_logo 2.svg') }}" alt="Telegram">
                                <span>Telegram</span>
                            </a>
                        </div>
                        <p class="manager-text">Задайте вопрос менеджеру</p>
                    </div>
                </div>
            </div>

            <!-- Правая часть с формой -->
            {{-- <div class="consultation-form bg-gradient"> --}}
            <!-- Добавьте обертку form-wrapper вокруг заголовка и формы -->
            <div class="form-wrapper">
                <h5>Получите бесплатную консультацию специалиста</h5>
                <form>
                    <div class="form-group">
                        <label for="phone">Ваш телефон: *</label>
                        <input type="text" class="form-control" id="phone" placeholder="Ваш телефон">
                    </div>
                    <div class="form-group">
                        <label for="email">Ваша почта:</label>
                        <input type="email" class="form-control" id="email" placeholder="Ваша почта">
                    </div>
                    <button type="submit" class="btn btn-custom">
                        <span class="icon-phone"></span> Жду звонка
                    </button>
                </form>
            </div>
            {{-- </div> --}}
        </div>
    </footer>
</body>

</html>
