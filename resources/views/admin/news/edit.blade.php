@extends('layouts.admin')
@section('title')Редактирование новости @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Редактировать новость</h1>
    </div>
    @include('admin.message')
    <div class="btn-toolbar mb-2 mb-md-0">
    <form method="post" action="{{ route('admin.news.update', ['news' => $news]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="categories">Категории</label>
            <select class="form-control" multiple name="categories[]" id="categories">
                @foreach($categories as $category)
                    <option @if(in_array($category->id, old('categories') ?? $news->categories->pluck('id')->toArray())) selected @endif value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="title">Заголовок</label>
            <br>
            @error('title') <strong class="text-danger">{{ $message }}</strong> @enderror
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $news->title }}"/>
        </div>
        <div class="form-group">
            <label for="author">Автор</label>
            <br>
            @error('author') <strong class="text-danger">{{ $message }}</strong> @enderror
            <input type="text" name="author" id="author" class="form-control" value="{{ old('author') ?? $news->author }}"/>
        </div>
        <div class="form-group">
            <label for="image">Изображение</label>
            <br>
            @error('image') <strong class="text-danger">{{ $message }}</strong> @enderror
            <input type="file" name="image" id="image" class="form-control" value="{{ old('image') ?? $news->image }}"/>
        </div>
        <div class="form-group">
            <label for="status">Статус</label>
            <br>
            @error('status') <strong class="text-danger">{{ $message }}</strong> @enderror
            <select class="form-control" name="status" id="status">
                <option @if(old('status') ?? $news->status === 'draft') selected @endif value="{{ \App\Enums\NewsStatus::DRAFT->value }}">DRAFT</option>
                <option @if(old('status') ?? $news->status === 'active') selected @endif value="{{ \App\Enums\NewsStatus::ACTIVE->value }}">ACTIVE</option>
                <option @if(old('status') ?? $news->status === 'blocked') selected @endif value="{{ \App\Enums\NewsStatus::BLOCKED->value }}">BLOCKED</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <br>
            @error('description') <strong class="text-danger">{{ $message }}</strong> @enderror
            <textarea class="form-control" name="description" id="description">{!! old('description') ?? $news->description !!}</textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
    </div>
@endsection
