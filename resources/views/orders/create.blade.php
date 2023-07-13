@extends('layouts.main')
@section('title')Создание заказа @parent @stop
@section('content')
    <div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Добавить заказ получение выгрузки данных</h1>
    </div>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <x-alert type="danger" :message="$error"></x-alert>
        @endforeach
    @endif
    <div class="btn-toolbar mb-2 mb-md-0">
        <form method="post" action="{{ route('orders.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Ваше имя</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"/>
            </div>
            <div class="form-group">
                <label for="phone">Ваш номер телефона</label>
                <input type="tel" name="phone" id="author" class="form-control" value="{{ old('phone') }}" placeholder="+7 999 123 45 67"/>
            </div>
            <div class="form-group">
                <label for="email">Ваш e-mail</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"/>
            </div>
            <div class="form-group">
                <label for="description">Что Вы хотите получить</label>
                <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
    </div>
@endsection
