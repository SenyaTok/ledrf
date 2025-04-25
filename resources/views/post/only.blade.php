@php
    $post = $theme['firstPost'];
    $replies = $theme['replies'];
@endphp

@extends('layouts.layout')

@section('title')
    {{ $post->theme }}
@endsection

@section('body')
    <div class="divider"></div>

    @auth
        @if (auth()->user()->role < 3)
            <div class="centering m-2">
                <form action="{{ @route('postEdit', ['id' => $post->id]) }}" method="post">
                    @csrf
                    <button class="btn btn-secondary m-2">Редактировать статью</button>
                </form>
                <form action="{{ @route('postDelete', ['id' => $post->id]) }}" method="post">
                    @csrf
                    <button class="btn btn-danger m-2">Удалить статью</button>
                </form>
            </div>
        @endif
    @endauth
    <br>
    <div class="p-2 widthing">
        <h3>
            {{ $post->theme }}
        </h3>
        <span>{!! $post->text !!}</span>
    </div>
    <br>
    <div class="divider"></div>
@endsection
