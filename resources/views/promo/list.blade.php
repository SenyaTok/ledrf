@extends('layouts.layout')

@section('title', $page->title_promo ?? 'Промо-страница')

@section('body')
<div class="container mt-4">
    <h2 class="mb-4">Промо-страницы</h2>

    @foreach ($pages as $page)
        <div class="mb-3">
            <h4>{{ $page->title_promo ?? $page->slug }}</h4>
            <p>{{ Str::limit(strip_tags($page->text_promo), 100) }}</p>
            <a href="/{{ $page->slug }}" class="btn btn-primary">Перейти</a>
        </div>
        <hr>
    @endforeach

    @if ($pages->isEmpty())
        <p>Пока нет ни одной промо-страницы.</p>
    @endif
</div>
@endsection