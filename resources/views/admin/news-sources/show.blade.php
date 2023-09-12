@extends('layouts.admin')
@section('title')Админка - {{ __('News Source') }} {{ $newsSource->title }} @parent @stop
@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ __('News Source') }} {{ $newsSource->title }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.news-sources.edit',['news_source' => $newsSource]) }}" type="button" class="btn btn-sm btn-outline-secondary">{{ __('Edit') }} {{ __('News Source') }}</a>
                <a href="{{ route('admin.news-sources.index') }}" type="button" class="btn btn-sm btn-outline-secondary">{{ __('Back') }}</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <tbody>
                <tr>
                    <td>Id</td>
                    <td>{{ $newsSource->id }}</td>
                </tr>
                <tr>
                    <td>{{ __('Title') }}</td>
                    <td>{{ $newsSource->title }}</td>
                </tr>
                <tr>
                    <td>{{ __('Source link') }}</td>
                    <td>{{ $newsSource->link }}</td>
                </tr>
                <tr>
                    <td>{{ __('Category') }}</td>
                    <td>{{ $newsSource->category->title }}</td>
                </tr>
                <tr>
                    <td>{{ __('Is Active') }}</td>
                    <td>{{ $newsSource->is_active ? 'Да': 'Нет'}}</td>
                </tr>
                <tr>
                    <td>{{ __('Created at')}}</td>
                    <td>{{ Date::createFromTimeString($newsSource->created_at)->format('d.m.Y H:i') }}</td>
                </tr>
                <tr>
                    <td>{{ __('Updated at') }}</td>
                    <td>{{ Date::createFromTimeString($newsSource->updated_at)->format('d.m.Y H:i') }}</td>
                </tr>
                <tr>
                    <td>{{ __('Last run at') }}</td>
                    <td>@if(isset($newsSource->last_run_at)) {{ Date::createFromTimeString($newsSource->last_run_at)->format('d.m.Y H:i') }} @else {{ __('Never') }} @endif</td>
                </tr>
            </table>
            <a class="btn btn-success" href="{{ route('admin.news-sources.edit', ['news_source' => $newsSource]) }}">{{ __('Edit') }}</a>&nbsp;
            <button class="btn btn-danger" name="delete" data-id="{{ $newsSource->id }}" data-resource="news-sources">{{ __('Delete') }}</button>
        </div>
    </div>
@endsection
