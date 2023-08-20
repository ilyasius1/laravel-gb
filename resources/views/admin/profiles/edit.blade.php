@extends('layouts.admin')
@section('title')Редактирование профиля {{ $profile->name }} @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Редактирование профиля {{ $profile->name }} </h1>
    </div>
    @include('admin.message')
    <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Данные профиля:</h4>
        <form method="post" action="{{ route('admin.profiles.update', ['profile' => $profile]) }}" class="needs-validation" novalidate enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="name" class="form-label">Name</label>@error('name') <strong class="text-danger">{{ $message }}</strong> @enderror
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $profile->name }}" required>
                    <div class="invalid-feedback">
                        Valid name is required.
                    </div>
                </div>

                <div class="col-12">
                    <label for="email" class="form-label">Email</label>@error('email') <strong class="text-danger">{{ $message }}</strong> @enderror
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com"  value="{{ old('email') ?? $profile->email }}" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>
            </div>
            <br>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" {{ old('is_admin') ?? $profile->is_admin ? 'checked' : '' }}>
                <label class="form-check-label" for="is_admin">is Admin</label>
            </div>
            <br>
            <button class="w-100 btn btn-primary btn-lg" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
