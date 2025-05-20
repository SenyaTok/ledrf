@extends('layouts.layout')

@section('title', $page->title_promo ?? 'Промо-страница')

@section('body')
    <div class="divider"></div>

    <!-- Hero Section -->
    <div class="text-center py-5">
        <h1 class="promo-title text-center bindigo-text">
            <span class="normal-case">Промо Ledplast</span>
            <span class="uppercase"> – ПРОМЫШЛЕННЫЕ СВЕТОДИОДНЫЕ СВЕТИЛЬНИКИ LEDPLAST</span>
        </h1>
        <p class="lead bgray-text">Уникальные предложения и акции от Ledplast - Уникальное сочетание цены и качества.
            Гарантия 7 лет!</p>
    </div>

    <div class="container mt-4">

        {{-- 1. Слайдер --}}
        @if (!empty($page->slider_images))
            <div id="promoSlider" class="carousel slide mb-4" data-ride="carousel" data-interval="5000">
                <ol class="carousel-indicators">
                    @foreach ($page->slider_images as $index => $image)
                        <li data-target="#promoSlider" data-slide-to="{{ $index }}"
                            class="{{ $loop->first ? 'active' : '' }}"></li>
                    @endforeach
                </ol>

                <div class="carousel-inner">
                    @foreach ($page->slider_images as $index => $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="slider-image-wrapper">
                                <img src="{{ asset($image) }}" alt="Слайд {{ $index + 1 }}">
                            </div>
                        </div>
                    @endforeach
                </div>

                <a class="carousel-control-prev" href="#promoSlider" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next" href="#promoSlider" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </a>
            </div>
        @endif

        {{-- 2. Таблица (2 блок) --}}
        @if ($tableRows->count())
            <div class="mb-4">
                <h4 class="table-title">Характеристики</h4>

                @php
                    $maxColumns = $tableRows->map(fn($r) => count($r->columns))->max() ?? 1;
                @endphp

                <div class="table-responsive">
                    <table class="table table-bordered table-fixed-layout">
                        @foreach ($tableRows as $row)
                            <tr>
                                @if (count($row->columns) === 1)
                                    @php
                                        $cellStr = is_string($row->columns[0]) ? $row->columns[0] : '';
                                        $classes = '';
                                        $text = $cellStr;

                                        if (str_starts_with($cellStr, '!')) {
                                            $classes = 'highlight-red';
                                            $text = ltrim($cellStr, '!');
                                        } elseif (str_starts_with($cellStr, '#')) {
                                            $classes = 'highlight-blue';
                                            $text = ltrim($cellStr, '#');
                                        }
                                    @endphp
                                    <td colspan="{{ $maxColumns }}" class="{{ $classes }}">{{ $text }}</td>
                                @else
                                    @foreach ($row->columns as $cell)
                                        @php
                                            $cellStr = is_string($cell) ? $cell : '';
                                            $classes = '';
                                            $text = $cellStr;

                                            if (str_starts_with($cellStr, '!')) {
                                                $classes = 'highlight-red';
                                                $text = ltrim($cellStr, '!');
                                            } elseif (str_starts_with($cellStr, '#')) {
                                                $classes = 'highlight-blue';
                                                $text = ltrim($cellStr, '#');
                                            }
                                        @endphp
                                        <td class="{{ $classes }}">{{ $text }}</td>
                                    @endforeach
                                @endif
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        @endif

        {{-- 3. Текст (3 блок) --}}
        @if ($page->text_promo)
            <div class="promo-text mb-5">
                {!! $page->text_promo !!}
            </div>
        @endif

    </div>
@endsection
