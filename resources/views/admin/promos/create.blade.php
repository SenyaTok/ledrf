@extends('layouts.layout')

@section('title', 'Создание промо-страницы')

@section('body')
<div class="container mt-4">
    <h2 class="mb-4">Создать промо-страницу</h2>

    <div class="form-wrapper-admin">
        <form action="{{ route('admin.promos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="slug">Slug (пример: promo-1)</label>
                <input type="text" name="slug" class="form-control" required value="{{ old('slug') }}">
                @error('slug') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group mb-3">
                <label for="title_promo">Заголовок</label>
                <input type="text" name="title_promo" class="form-control" value="{{ old('title_promo') }}">
            </div>

            <div class="form-group mb-3">
                <label for="text_promo">Текст (описание)</label>
                <textarea name="text_promo" class="form-control tinyMCE" rows="5">{{ old('text_promo') }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="slider_images">Изображения для слайдера (можно выбрать несколько)</label>
                <input type="file" name="slider_images[]" class="form-control" multiple>
                @error('slider_images.*') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-success">Создать</button>
            <a href="{{ route('admin.promos.index') }}" class="btn btn-secondary">Назад</a>
        </form>
    </div>
</div>
@endsection