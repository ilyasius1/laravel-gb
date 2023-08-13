@extends('layouts.admin')
@section('title')Админка - список категорий @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список категорий</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.categories.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить категорию</a>
            </div>
        </div>
    </div>
    @if(!$categoriesList)
        <div>Категорий нет</div>
    @else
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Название</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Количество статей</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col">Действия </th>
                </tr>
                </thead>
                <tbody>
                @foreach($categoriesList as $key => $category)
                    <tr>
                        <td><a href="{{ route('admin.categories.show',['category' => $category]) }}">{{ $category->id }}</td>
                        <td><a href="{{ route('admin.categories.show',['category' => $category]) }}">{{ $category->title }}</td>
                        <td>{{ $category->description }}</a></td>
                        <td>{{ $category->news()->count() }}</td>
                        <td>{{ Date::createFromTimeString($category->created_at)->format('d.m.Y H:i') }}</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('admin.categories.edit', ['category' => $category]) }}">Edit</a>&nbsp;
                            <button class="btn btn-danger" name="delete" data-id="{{ $category->id }}" data-resource="categories">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $categoriesList->links() }}
        </div>
    @endif
@endsection
