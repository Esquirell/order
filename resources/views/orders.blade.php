@extends('layouts.app')

@section('content')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Сумма</th>
            <th scope="col">Hash</th>
            <th scope="col">Проверить</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <th scope="row">{{$order->id}}</th>
                <td>{{$order->amount}}</td>
                <td>{{$order->hash}}</td>
                <td><a href="{{route('check', $order->id)}}">Проверить</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
