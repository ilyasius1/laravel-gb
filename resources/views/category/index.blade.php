@extends('layouts.main')
@section('header')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Список категорий:</h1>
                <p class="lead text-body-secondary">Список категорий, по которым разбиты статьи</p>
            </div>
        </div>
    </section>
@endsection
@section('content')
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @forelse ($categoriesList as $key => $category)
            <div class="col">
                <div class="card shadow-sm">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                    <div class="card-body">
                        <p class="card-text">{{ $category['name'] }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('category.show', ['id' => $category['id']]) }}" type="button" class="btn btn-sm btn-outline-secondary">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <h2>Категорий нет</h2>
            @endforelse
        </div>
    </div>
@endsection
