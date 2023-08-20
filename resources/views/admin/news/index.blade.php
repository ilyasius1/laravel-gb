@php use Illuminate\Support\Carbon; @endphp
@extends('layouts.admin')
@section('title')
    Админка - список новостей @parent
@stop
@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список новостей</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.news.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить
                    новость</a>
            </div>
        </div>
    </div>
    <h2>Список новостей</h2>
    @include('admin.message')
    @if(empty($newsList))
        <div>Новостей нет</div>
    @else
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th>Категории</th>
                    <th scope="col">Название</th>
                    <th scope="col">Автор</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col">Действия </th>
                </tr>
                </thead>
                <tbody>
                @foreach($newsList as $key => $newsItem)
                    <tr>
                        <td><a href="{{ route('admin.news.show',['news' => $newsItem]) }}">{{ $newsItem->id }}</a>
                        </td>
                        <td>
                            @foreach($newsItem->categories as $category)
                            <a href="{{ route('admin.categories.show',['category' => $category]) }}">{{ $category->title }}</a>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('admin.news.show',['news' => $newsItem]) }}">{{ $newsItem->title }}</a>
                        </td>
                        <td>{{ $newsItem->author }}</a></td>
                        <td>{{ $newsItem->status }}</a></td>
                        <td>{{ Date::createFromTimeString($newsItem->created_at)->format('d.m.Y H:i') }}</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('admin.news.edit', ['news' => $newsItem]) }}">Edit</a>&nbsp;
                            <button class="btn btn-danger" name="delete" data-id="{{ $newsItem->id }}" data-resource="news">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $newsList->links() }}
        </div>
    @endif
@endsection
