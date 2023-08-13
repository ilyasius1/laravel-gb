@extends('layouts.admin')
@section('title')Админка - Новость {{ $news->title }} @parent @stop
@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $news->title }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.news.edit',['news' => $news]) }}" type="button" class="btn btn-sm btn-outline-secondary">Редактировать
                    новость</a>
                <a href="{{ route('admin.news.index') }}" type="button" class="btn btn-sm btn-outline-secondary">Назад</a>
            </div>
        </div>
    </div>
    <div class="container">
        <p class="lead text-body-secondary">{!! $news->description !!}</p>
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-body-secondary">{{ $news->author }} ({{ Date::createFromTimeString($news->created_at)->format('d.m.Y H:i') }})</small>
        </div>
    </div>
    </div>
@endsection

