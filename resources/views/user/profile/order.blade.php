@extends('layouts.user.profile')

@push('head')
    <link rel="stylesheet" href="{{asset("assets/user/css/order.css")}}"> 
@endpush

@section('information')
    <div class="title-information">
        <h2 class="title">Đơn hàng của bạn</h2>
        <div class="order-bar">
            <div class="order-confirm order">
                <a href="{{route("profile.order.show")}}" onclick="order_function(event)" name="confirm"><img src="{{asset("assets/user/img/confirm-order.png")}}" alt=""></a>
                <p>Đang chờ xác nhận <span class="quantity" style="color: red">(1)</span></p>
            </div>
            <div class="order-in-transit order">
                <a href="{{route("profile.order.show")}}" onclick="order_function(event)" name="transit"><img src="{{asset("assets/user/img/shipping.png")}}" alt=""></a>
                <p>Đang vận chuyển đến bạn <span class="quantity" style="color: red">(1)</span></p>
            </div>
            <div class="order-delivered order">
                <a href="{{route("profile.order.show")}}" onclick="order_function(event)" name="delivered"><img src="{{asset("assets/user/img/delivered.png")}}" alt=""></a>
                <p>Đã được vận chuyển đến bạn <span class="quantity" style="color: red">(1)</span></p>
            </div>
        </div>
    </div>
    <div class="title-information late">
        <h2 class="title">Thông tin đơn hàng</h2>
        <p>Chọn vào biểu tượng để hiển thị thông tin đơn hàng</p>
        @include('layouts.components.product_ui_in_cart')
    </div>
@endsection

@push('footer')
    <script src="{{asset("assets/user/js/profile.js")}}"></script>
@endpush