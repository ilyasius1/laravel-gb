@extends('layouts.admin')
@section('title')Админка - главная @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Админка</h1>
    </div>
<h2>Адимнка - главная страница</h2>
    @if(!empty($showAlert))
    <x-alert :type="request()->get('type', 'success')" message="Some message"></x-alert>
    <x-alert type="success" message="success"></x-alert>
    <x-alert type="warning" message="warning"></x-alert>
    <x-alert type="info" message="info"></x-alert>
    <x-alert type="danger" message="danger"></x-alert>
    <x-alert type="alert" message="alert"></x-alert>
    @endif
    <div class="btn-group me-2">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-secondary">Перейти к категориям</a>
        <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-outline-secondary">Перейти к списку статей</a>
    </div>
@endsection
