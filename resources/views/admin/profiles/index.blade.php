@php use Illuminate\Support\Carbon; @endphp
@extends('layouts.admin')
@section('title')
    Админка - список пользователей @parent
@stop
@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список пользователей</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.profiles.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить
                    пользователя</a>
            </div>
        </div>
    </div>
    @include('admin.message')
    @if(empty($profiles))
        <div>Пользователей нет</div>
    @else
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Имя пользователя</th>
                    <th scope="col">Email</th>
                    <th scope="col">Является администратором</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col">Дата изменения</th>
                    <th scope="col">Действия </th>
                </tr>
                </thead>
                <tbody>
                @foreach($profiles as $key => $profile)
                    <tr>
                        <td><a href="{{ route('admin.profiles.show',['profile' => $profile]) }}">{{ $profile->id }}</a>
                        </td>
                        <td>
                            <a href="{{ route('admin.profiles.show',['profile' => $profile]) }}">{{ $profile->name }}</a>
                        </td>
                        <td>{{ $profile->email }}</td>
                        <td><input class="form-check-input" type="checkbox" disabled @checked($profile->is_admin)></td>
                        <td>{{ Date::createFromTimeString($profile->created_at)->format('d.m.Y H:i') }}</td>
                        <td>{{ Date::createFromTimeString($profile->updated_at)->format('d.m.Y H:i') }}</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('admin.profiles.edit', ['profile' => $profile]) }}">Edit</a>&nbsp;
                            <button class="btn btn-danger" name="delete" data-id="{{ $profile->id }}" data-resource="profile">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $profiles->links() }}
        </div>
    @endif
@endsection
