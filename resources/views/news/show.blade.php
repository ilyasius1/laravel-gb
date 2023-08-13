@extends('layouts.main')
@section('title') Новость {{ $news->title }} @parent @stop
@section('header')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">{{ $news->title }}</h1>
            </div>
        </div>
    </section>
@endsection
@section('content')
    <div class="container">
        <p class="lead text-body-secondary">{!! $news->description !!}</p>
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-body-secondary">{{ $news->author }} ({{ Date::createFromTimeString($news->created_at)->format('d.m.Y H:i') }})</small>
        </div>
    </div>
    </div>
@endsection

