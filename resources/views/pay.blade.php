@extends('layouts.app')
@section('content')
    <form method="post" action="{{url('/pay')}}" accept-charset="utf-8">
        @csrf
{{--        <div class="form-row">--}}
{{--            <div class="form-group col-md-4">--}}
{{--                Идентификатор продавца--}}
{{--                <input class="form-control" name="merchantAccount" value="test_merch_n1">--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-4">--}}
{{--                Тип авторизации--}}
{{--                <input class="form-control" name="merchantAuthType" value="SimpleSignature">--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-4">--}}
{{--                Доменное имя веб-сайта торговца--}}
{{--                <input class="form-control" name="merchantDomainName" value="127.0.0.1:8000">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="form-row">--}}
{{--            <div class="form-group col-md-4">--}}
{{--                Подпись запроса--}}
{{--                <input class="form-control" name="merchantSignature" value="{{$hash}}">--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-4">--}}
{{--                Уникальный номер заказа в системе торговца--}}
{{--                <input class="form-control" name="orderReference" value="ID10">--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-4">--}}
{{--                Дата размещение заказа--}}
{{--                <input class="form-control" name="orderDate" value="1625762827">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="form-row">--}}
{{--            <div class="form-group col-md-4">--}}
{{--                Сумма заказа--}}
{{--                <input class="form-control" name="amount" value="150">--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-4">--}}
{{--                Валюта заказа--}}
{{--                <input class="form-control" name="currency" value="UAH">--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-4">--}}
{{--                Время оплаты (с)--}}
{{--                <input class="form-control" name="orderTimeout" value="49000">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="form-row">--}}
{{--            <div class="form-group col-md-4">--}}
{{--                Массив с наименованием заказанных товаров--}}
{{--                <input class="form-control" name="productName[]" value="привет">--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-4">--}}
{{--                Цена товара--}}
{{--                <input class="form-control" name="productPrice[]" value="1">--}}
{{--            </div>--}}
            <div class="form-group col-md-4">
                Количество кредитов
                <input class="form-control" name="productCount[]" value="">
            </div>
{{--        </div>--}}
{{--        <div class="form-row">--}}
{{--            <div class="form-group col-md-4">--}}
{{--                Имя клиента--}}
{{--                <input class="form-control" name="clientFirstName" value="Вася">--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-4">--}}
{{--                Фамилия клиента--}}
{{--                <input class="form-control" name="clientLastName" value="Пупкин">--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-4">--}}
{{--                Адрес клиента--}}
{{--                <input class="form-control" name="clientAddress" value="пр. Гагарина, 12">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="form-row">--}}
{{--            <div class="form-group col-md-4">--}}
{{--                Город клиента--}}
{{--                <input class="form-control" name="clientCity" value="Днепропетровск">--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-4">--}}
{{--                Почта клиента--}}
{{--                <input class="form-control" name="clientEmail" value="some@mail.com">--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-4">--}}
{{--                хз--}}
{{--                <input class="form-control" name="defaultPaymentSystem" value="card">--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        --}}{{--    <input name="deliveryList" value="nova">--}}
{{--        Доставка--}}
{{--        <select name="deliveryList">--}}
{{--            <option value="nova">Новая почта</option>--}}
{{--            <option value="ukrpost">УкрПочта</option>--}}
{{--        </select>--}}
        <button type="submit">Оплатить</button>

    </form>
@endsection
