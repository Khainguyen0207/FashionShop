@extends('layouts.user')
@push('head')
    <link rel="shortcut icon" href="{{asset('assets/user/img/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/pay.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    
    <title>Giỏ hàng</title>
@endpush
@section('content')
    @include('layouts.user.header')
    <div id="container">
        <div class="form-order">
            <div class="header">
                <h1 class="title pay">Thanh toán</h1>
            </div>
            <div class="content">
                <div class="recipient-information">
                    <h3 class="item">Thông tin người nhận</h3>
                    <form action="?" method="get">
                        <label for="recipient-name">Tên người nhận</label>
                        <input type="text" name="recipient-name" id="recipient-name" spellcheck="false" max="255" maxlength="100">
                        <label for="number-phone" >Số điện thoại</label>
                        <input type="number" name="numberphone" id="number-phone" max="255"  spellcheck="false" maxlength="100">
                        <label for="address">Địa chỉ nhận hàng</label>
                        <input type="text" name="address" id="address" spellcheck="false" max="255" maxlength="100">
                    </form>
                </div>
                <div class="order-information">
                    <h3 class="item">Thông tin đơn hàng</h3>
                    <table>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                        </tr>
                        @for ($i = 0; $i < 1; $i++)
                            <tr>
                                <td>1. Quần da đen  - 3 lỗ</td>
                                <td>10</td>
                            </tr>
                        @endfor
                    </table>
                </div>
                <div class="payment-method">
                    <h3 class="item">Phương thức thanh toán</h3>
                    <h5>Chọn phương thức thanh toán</h5>
                    <form action="" method="GET"class="select-banking">
                        <a href="?momo" class="banking"><img src="{{asset('assets/img/momo.png')}}" alt=""></a>
                        <a href="?mbbank" class="banking"><img src="{{asset('assets/img/mbbank.png')}}" alt=""></a>
                        <a href="?vietcombank" class="banking"><img src="{{asset('assets/img/vietcombank.png')}}" alt=""></a>
                        <a href="?home-bank" class="banking"><img src="{{asset('assets/img/home-bank.png')}}" alt=""></a>
                    </form>
                </div>
            </div>
            <div class="footer">
                <h3 class="total">Tổng tiền</h3>
                <h3 class="total">3000000 <span>VNĐ</span></h3>
                <a href="" class="btn btn-order">Đặt hàng</a>
            </div>
        </div>
    </div>
    @include('layouts.user.footer')
@endsection