@extends('layouts.user.profile')

@push('head')
    <link rel="stylesheet" href="{{asset("assets/user/css/order.css")}}"> 
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

@endpush

@section('information')
    <div class="title-information">
        <h2 class="title">Đơn hàng của bạn</h2>
        <div class="order-bar">
            <div class="order-confirm order">
                <a href="{{route("profile.order.show")}}" onclick="order_function(event)" name="confirm"><img src="{{asset("assets/user/img/confirm-order.png")}}" alt=""></a>
                <p>Đang chờ xác nhận <span class="quantity" style="color: red">( {{$confirm}} )</span></p>
            </div>
            <div class="order-in-transit order">
                <a href="{{route("profile.order.show")}}" onclick="order_function(event)" name="transit"><img src="{{asset("assets/user/img/shipping.png")}}" alt=""></a>
                <p>Đang vận chuyển đến bạn <span class="quantity" style="color: red">({{$transit}})</span></p>
            </div>
            <div class="order-delivered order">
                <a href="{{route("profile.order.show")}}" onclick="order_function(event)" name="delivered"><img src="{{asset("assets/user/img/delivered.png")}}" alt=""></a>
                <p>Đã được vận chuyển đến bạn <span class="quantity" style="color: red">({{$delivered}})</span></p>
            </div>
        </div>
    </div>
    <h2 class="title">Thông tin đơn hàng</h2>
    <div class="title-information late">
        <p>Chọn vào biểu tượng để hiển thị thông tin đơn hàng</p>
    </div>
@endsection

@push('footer')
    <script src="{{asset("assets/user/js/profile.js")}}"></script>
@endpush