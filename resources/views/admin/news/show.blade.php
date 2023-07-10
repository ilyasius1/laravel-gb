@extends('layouts.admin')
@section('title')Админка - Новость {{ $news['title'] }} @parent @stop
@section('content')
    <div class="container">
        <p class="lead text-body-secondary">{!! $news['description'] !!}</p>
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-body-secondary">{{ $news['author'] }} ({{ $news['created_at']->format('d-m-Y H:i') }})</small>
        </div>
    </div>
    </div>
@endsection

