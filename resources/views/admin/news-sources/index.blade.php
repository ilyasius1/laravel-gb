@extends('layouts.admin')
@section('title')Админка - список источников новостей @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список источников</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.news-sources.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить источник</a>
            </div>
        </div>
    </div>
    @if(!$newsSources)
        <div>Источников нет</div>
    @else
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">{{ __('Title') }}</th>
                    <th scope="col">{{ __('Source link') }}</th>
                    <th scope="col">{{ __('Category') }}</th>
                    <th scope="col">{{ __('Is Active') }}</th>
                    <th scope="col">{{ __('Created at')}}</th>
                    <th scope="col">{{ __('Updated at') }}</th>
                    <th scope="col">{{ __('Last run at') }}</th>
                    <th scope="col">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($newsSources as $key => $newsSource)
                    <tr>
                        <td><a href="{{ route('admin.news-sources.show',['news_source' => $newsSource]) }}">{{ $newsSource->id }}</td>
                        <td><a href="{{ route('admin.news-sources.show',['news_source' => $newsSource]) }}">{{ $newsSource->title }}</td>
                        <td><a href="{{ $newsSource->link }}">{{ $newsSource->link }}</a></td>
                        <td>{{ $newsSource->category->title }}</td>
                        <td><input class="form-check-input" type="checkbox" disabled @checked($newsSource->is_active)></td>
                        <td>{{ Date::createFromTimeString($newsSource->created_at)->format('d.m.Y H:i') }}</td>
                        <td>{{ Date::createFromTimeString($newsSource->updated_at)->format('d.m.Y H:i') }}</td>
                        <td>@if(isset($newsSource->last_run_at)) {{ Date::createFromTimeString($newsSource->last_run_at)->format('d.m.Y H:i') }} @else {{ __('Never') }} @endif</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('admin.news-sources.edit', ['news_source' => $newsSource]) }}">{{ __('Edit') }}</a>&nbsp;
                            <button class="btn btn-danger" name="delete" data-id="{{ $newsSource->id }}" data-resource="news-sources">{{ __('Delete')}}</button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
@endsection
