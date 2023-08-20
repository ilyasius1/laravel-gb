@extends('layouts.admin')
@section('title')Создание новости @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Добавить профиль</h1>
    </div>
    @include('admin.message')
    <div class="btn-toolbar mb-2 mb-md-0">
        <form method="post" action="{{ route('admin.profiles.store') }}" class="needs-validation" novalidate enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="name" class="form-label">Name</label>@error('name') <strong class="text-danger">{{ $message }}</strong> @enderror
                    <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') ?? '' }}" required>
                    <div class="invalid-feedback">
                        Valid name is required.
                    </div>
                </div>

                <div class="col-12">
                    <label for="email" class="form-label">Email Address</label>@error('email') <strong class="text-danger">{{ $message }}</strong> @enderror
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com"  value="{{ old('email') ?? ''}}" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="col-12">
                    <label for="password" class="form-label">{{ __('Password') }}</label>@error('password') <strong class="text-danger">{{ $message }}</strong> @enderror
                    <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('enter_password') }}" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>
                <div class="col-12">
                    <label for="password" class="form-label">{{ __('password_confirmation') }}</label>@error('password_confirmation') <strong class="text-danger">{{ $message }}</strong> @enderror
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ __('confirm_password') }}" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>
            </div>
            <br>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" {{ old('is_admin') ? 'checked' : '' }}>
                <label class="form-check-label" for="is_admin">Администратор</label>
            </div>
            <br>
            <button class="w-100 btn btn-primary btn-lg" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
