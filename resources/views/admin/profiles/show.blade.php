@extends('layouts.admin')
@section('title')Админка - Просмотр профиля {{ $profile->name }} @parent @stop
@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Профиль пользователя {{ $profile->name }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.profiles.edit',['profile' => $profile]) }}" type="button" class="btn btn-sm btn-outline-secondary">Редактировать
                    профиль</a>
                <a href="{{ route('admin.profiles.index') }}" type="button" class="btn btn-sm btn-outline-secondary">Назад</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <tbody>
                    <tr>
                        <td>Profile Id</td>
                        <td>{{ $profile->id }}</td>
                    </tr>
                    <tr>
                        <td>Profile name</td>
                        <td>{{ $profile->name }}</td>
                    </tr>
                    <tr>
                        <td>Profile email</td>
                        <td>{{ $profile->email }}</td>
                    </tr>
                    <tr>
                        <td>is Admin</td>
                        <td>{{ $profile->isAdmin ? 'Да': 'Нет'}}</td>
                    </tr>
                    <tr>
                        <td>Created at</td>
                        <td>{{ Date::createFromTimeString($profile->created_at)->format('d.m.Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td>Updated at</td>
                        <td>{{ Date::createFromTimeString($profile->updated_at)->format('d.m.Y H:i') }}</td>
                    </tr>
            </table>
            <a class="btn btn-success" href="{{ route('admin.profiles.edit', ['profile' => $profile]) }}">Edit</a>&nbsp;
            <button class="btn btn-danger" name="delete" data-id="{{ $profile->id }}" data-resource="profile">Delete</button>
    </div>
    </div>
@endsection
