@extends('layouts.admin')
@section('title')Создание категории @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ __('Edit') }} {{ __('News Source') }} {{ $newsSource->title }}</h1>
    </div>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <x-alert type="danger" :message="$error"></x-alert>
        @endforeach
    @endif
    <div class="btn-toolbar mb-2 mb-md-0">
        <form method="post" action="{{ route('admin.news-sources.update', ['news_source' => $newsSource]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="title">{{ __('Title') }}</label>
                @error('title') <strong class="text-danger">{{ $message }}</strong> @enderror
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $newsSource->title }}"/>
                <br>
                <label for="link">{{ __('Source link') }}</label>
                @error('link') <strong class="text-danger">{{ $message }}</strong> @enderror
                <input type="text" name="link" id="link" class="form-control" value="{{ old('link') ?? $newsSource->link }}"/>
                <br>
                <label for="category_id">{{ __('Category') }}</label>
                @error('categories') <strong class="text-danger">{{ $message }}</strong> @enderror
                <select class="form-control" name="category_id" id="category_id">
                    <option @selected(!old('category')) value="{{ null }}">Нет категории</option>
                    @foreach($categories as $category)
                        <option @selected($category->id === (old('category') ?? $newsSource->category->id) ) value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
                <br>
            </div>
            <div class="form-group">
                @error('item_field') <strong class="text-danger">{{ $message }}</strong> @enderror
                <label for="item_field">item_field</label>
                <input type="text" name="item_field" id="item_field" class="form-control" value="{{ old('item_field') ?? $newsSource->item_field }}"/>
                <label for="title_field">title_field</label>
                @error('title_field') <strong class="text-danger">{{ $message }}</strong> @enderror
                <input type="text" name="title_field" id="title_field" class="form-control" value="{{ old('title_field') ?? $newsSource->title_field }}"/>
                <label for="author_field">author_field</label>
                @error('author_field') <strong class="text-danger">{{ $message }}</strong> @enderror
                <input type="text" name="author_field" id="author_field" class="form-control" value="{{ old('author_field') ?? $newsSource->author_field }}"/>
                <label for="image_field">image_field</label>
                @error('image_field') <strong class="text-danger">{{ $message }}</strong> @enderror
                <input type="text" name="image_field" id="image_field" class="form-control" value="{{ old('image_field') ?? $newsSource->image_field }}"/>
                <label for="description_field">description_field</label>
                @error('description_field') <strong class="text-danger">{{ $message }}</strong> @enderror
                <input type="text" name="description_field" id="description_field" class="form-control" value="{{ old('description_field') ?? $newsSource->description_field }}"/>
                <label for="origin_link_field">origin_link_field</label>
                @error('origin_link_field') <strong class="text-danger">{{ $message }}</strong> @enderror
                <input type="text" name="origin_link_field" id="origin_link_field" class="form-control" value="{{ old('origin_link_field') ?? $newsSource->origin_link_field }}"/>
                <label for="pub_date_field">pub_date_field</label>
                <input type="text" name="pub_date_field" id="pub_date_field" class="form-control" value="{{ old('pub_date_field') ?? $newsSource->pub_date_field }}"/>
                <br>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" {{ old('is_active') ?? $newsSource->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">{{ __('Is Active') }}</label>
                </div>
                <br>
            </div>
            <br>
            <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('admin.news-sources.index') }}" class="btn btn-primary">{{ __('Back') }}</a>
        </form>
    </div>
@endsection
