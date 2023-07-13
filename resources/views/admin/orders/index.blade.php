@extends('layouts.admin')
@section('title')Админка - список заказов @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список заказов</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.orders.create') }}" type="button" class="btn btn-sm btn-outline-secondary">Добавить заказ</a>
            </div>
        </div>
    </div>
    @if(empty($orders))
        <x-alert type="info" message="Заказов нет"></x-alert>
    @else
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Дата создания</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $key => $order)
                    <tr>
                        <td><a href="{{ route('admin.orders.show',['order' => $order['id']]) }}">{{ $order['id'] }}</a></td>
                        <td><a href="{{ route('admin.orders.show',['order' => $order['id']]) }}">{{ $order['name'] }}</a></td>
                        <td><a href="{{ route('admin.orders.show',['order' => $order['id']]) }}">{{ $order['phone'] }}</a></td>
                        <td><a href="{{ route('admin.orders.show',['order' => $order['id']]) }}">{{ $order['email'] }}</a></td>
                        <td><a href="{{ route('admin.orders.show',['order' => $order['id']]) }}">{{ $order['description'] }}</a></td>
                        <td>{{ Date::createFromTimeString($order['created_at'])->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
@endsection
