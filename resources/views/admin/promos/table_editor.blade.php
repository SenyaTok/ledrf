@extends('layouts.layout')

@section('title', 'Редактирование таблицы — ' . ($page->title_promo ?? $page->slug))

@section('body')
<div class="container mt-4">
    <h2>Таблица: {{ $page->slug }}</h2>

    <form action="{{ route('admin.promos.table.store', $page->id) }}" method="POST">
        @csrf

        <div id="row-container" class="mb-3">
            <h5>Добавить строку:</h5>
        
            <div class="d-flex flex-wrap gap-2 mb-2" id="new-row">
                <input type="text" class="form-control mb-2" name="columns[]" placeholder="Ячейка 1">

            </div>
        
            <div class="d-flex">
                <button type="submit" class="btn btn-success" style="margin-right: 10px;">Добавить строку</button>
                <button type="button" class="btn btn-success" onclick="addColumn()">+ Ячейка</button>
            </div>
        </div>
    </form>

    <hr>

    <h5>Существующие строки</h5>

    @foreach ($tableRows as $row)
        <div class="mb-2 border rounded p-2">
            <form action="{{ route('admin.promos.table.update', $row->id) }}" method="POST" class="mb-1 d-flex flex-wrap gap-2 align-items-center">
                @csrf
                @method('PUT')
                @foreach ($row->columns as $i => $cell)
                    <input type="text" class="form-control mb-1" name="columns[]" value="{{ $cell }}" placeholder="Ячейка {{ $i+1 }}">
                @endforeach
                <button class="btn btn-sm btn-primary me-2">Сохранить</button>
            </form>
            <form action="{{ route('admin.promos.table.delete', $row->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Удалить строку?')">Удалить</button>
            </form>
        </div>
    @endforeach
</div>

<script>
function addColumn() {
    const container = document.getElementById('new-row');
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'columns[]';
    input.classList.add('form-control', 'mb-2');
    input.placeholder = 'Новая ячейка';
    container.appendChild(input);
}
</script>
@endsection