@extends('layouts.admin')
@section('title')Админка - заказ #{{ $order['id'] }} @parent @stop
@section('content')
    <div class="container">
        <p class="lead text-body-secondary">{{ $order['name'] }}</p>
        <p class="lead text-body-secondary">{{ $order['phone'] }}</p>
        <p class="lead text-body-secondary">{{ $order['email'] }}</p>
        <p class="lead text-body-secondary">{{ $order['description'] }}</p>
    </div>
    </div>
@endsection

