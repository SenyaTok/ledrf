@extends('layouts.layout')

@section('title')
    Редактирование услуги
@endsection

@section('body')
    <form action="{{ route('serviceSave') }}" method="POST" enctype="multipart/form-data"
        class="border border-secondary rounded m-2 p-3 form-auth">
        @csrf
        <input type="hidden" name="service_id" value="{{ $data['service']->id }}">
        <div class="form-block-wrapper border border-secondary rounded">
            <input type="text" name="name" class="name-inp" placeholder="Наименование услуги"
                value="{{ old('name', $data['service']->name) }}">
        </div>
        <div class="form-block-wrapper border border-secondary rounded">
            <textarea name="description" class="tinyMCE" placeholder="Описание услуги">
            {{ old('description', $data['service']->description) }}
        </textarea>
        </div>
        <!-- Файл для услуг -->
        <div class="form-block-wrapper border border-secondary rounded">
            <label for="service_file">Прикрепить файл:</label>
            <input type="file" name="file" id="service_file" class="form-control">
        </div>
        <!-- Изображения для услуг -->
        <div class="form-block-wrapper border border-secondary rounded">
            <input type="file" name="images[]" multiple>
        </div>
        <!-- Выбор категории услуги -->
        <div class="form-block-wrapper border border-secondary rounded">
            <select name="service_type_id" id="service_type_id">
                <option value="" disabled {{ $data['service']->service_type_id ? '' : 'selected' }}>Выберите тип
                    услуги</option>
                @foreach ($data['sTypes'] as $type)
                    <option value="{{ $type->id }}"
                        {{ $data['service']->service_type_id == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-block-wrapper">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection
