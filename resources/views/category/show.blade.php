@extends('layouts.main')
@section('title') Список новостей @parent @stop
@section('header')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Список новостей:</h1>
                <p class="lead text-body-secondary">Новости в категории {{ $category['name'] }}</p>
            </div>
        </div>
    </section>
@endsection
@section('content')
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @forelse ($category->news as $key => $newsItem)
                <div class="col">
                    <div class="card shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                        <div class="card-body">
                            <p><strong><a href="{{ route('news.show', ['news' => $newsItem]) }}">{{ $newsItem->title }}</a></strong></p>
                            <p class="card-text">{!! $newsItem['description'] !!}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{ route('news.show', ['news' => $newsItem]) }}" type="button" class="btn btn-sm btn-outline-secondary">Подробнее</a>
                                </div>
                                <small class="text-body-secondary">{{ $newsItem->author }} ({{ $newsItem->created_at->format('d-m-Y H:i') }})</small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h2>Новостей нет</h2>
            @endforelse
        </div>
    </div>
@endsection
{{--<h1>{{ $category['name'] }}</h1>--}}
{{--@forelse($category['news'] as $key => $news)--}}
{{--    <div style="border: 1px solid green;">--}}
{{--        <h2><a href="{{ route('news.show', ['id' => $key]) }}">{{ $news['title'] }}</a></h2>--}}
{{--        <p>{{ $news['author'] }} - {{ $news['created_at']->format('d-m-Y H:i') }}</p>--}}
{{--        <p>{!! $news['description'] !!}</p>--}}
{{--    </div><br><hr>--}}
{{--@empty--}}
{{--    <h2>Новостей нет</h2>--}}
{{--@endforelse--}}
