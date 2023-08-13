@extends('layouts.admin')
@section('title')Редактирование категории @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Редактировать категорию</h1>
    </div>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <x-alert type="danger" :message="$error"></x-alert>
        @endforeach
    @endif
    <div class="btn-toolbar mb-2 mb-md-0">
        <form method="post" action="{{ route('admin.categories.update', ['category' => $category]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $category->title }}"/>
                <label for="description">Описание</label>
                <textarea class="form-control" name="description" id="description">{{ $category->description }}</textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
@endsection
