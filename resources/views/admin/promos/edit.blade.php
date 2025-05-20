@extends('layouts.layout')


@section('title', $page->title_promo ?? 'Редактирование промо-страницы')

@section('body')
<div class="container mt-4">
    <h2>Редактировать промо-страницу</h2>

    <div class="form-wrapper-admin">
        {{-- Основная форма обновления страницы --}}
        <form action="{{ route('admin.promos.update', $page->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="slug">Slug (пример: promo-1)</label>
                <input type="text" name="slug" class="form-control" required value="{{ old('slug', $page->slug) }}">
                @error('slug') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group mb-3">
                <label for="title_promo">Заголовок</label>
                <input type="text" name="title_promo" class="form-control" value="{{ old('title_promo', $page->title_promo) }}">
            </div>

            <div class="form-group mb-3">
                <label for="text_promo">Текст (описание)</label>
                <textarea name="text_promo" class="form-control tinyMCE" rows="5">{{ old('text_promo', $page->text_promo) }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="slider_images">Добавить изображения в слайдер</label>
                <input type="file" name="slider_images[]" class="form-control" multiple>
                @error('slider_images.*') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('admin.promos.index') }}" class="btn btn-secondary">Назад</a>
        </form>

        {{-- Отдельный блок для текущих изображений с удалением --}}
        @if ($page->slider_images)
            <div class="mt-4">
                <label>Текущие изображения:</label>
                <div class="d-flex flex-wrap">
                    @foreach ($page->slider_images as $index => $img)
                        <div style="position: relative; display: inline-block; margin: 5px;">
                            <img src="{{ asset($img) }}" alt="" style="max-height: 100px;">
                            <form action="{{ route('admin.promos.image.delete', [$page->id, $index]) }}" method="POST" style="position: absolute; top: 0; right: 0;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить изображение?')">×</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection