@extends('layouts.layout')

@section('title', 'Список промо-страниц')

@section('body')
<div class="container mt-4">
    <h2>Промо-страницы</h2>

    {{-- Кнопка добавления новой страницы --}}
    <a href="{{ route('admin.promos.create') }}" class="btn btn-success mb-3">+ Новая промо-страница</a>

    {{-- Сообщение об успехе --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Таблица промо-страниц --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Slug</th>
                <th>Заголовок</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pages as $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{{ $page->slug }}</td>
                    <td>{{ $page->title_promo ?? 'Без названия' }}</td>
                    <td class="d-flex flex-wrap gap-1">
                        <a href="{{ route('promo.show', $page->slug) }}" class="btn btn-sm btn-info">Посмотреть</a>
                        <a href="{{ route('admin.promos.edit', $page->id) }}" class="btn btn-sm btn-primary">Редактировать</a>
                        <a href="{{ route('admin.promos.table.editor', $page->id) }}" class="btn btn-sm btn-warning">Таблица</a>
                        <form action="{{ route('admin.promos.destroy', $page->id) }}" method="POST" onsubmit="return confirm('Удалить страницу?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection