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
                    <form action="?" method="get" class="information">
                        <label for="recipient-name">Tên người nhận</label>
                        <input type="text" name="recipient-name" id="recipient-name" spellcheck="false" max="255" maxlength="100" required="required">
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
                            <th>Tổng tiền</th>
                        </tr>
                        @foreach ($products as $info_product_bill)
                            <tr>
                                <td>{{ $info_product_bill['name'] }}</td>
                                <td>{{ $info_product_bill['quantity'] }}</td>
                                <td>{{ $info_product_bill['price_product'] }} VNĐ</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="payment-method">
                    <h3 class="item">Phương thức thanh toán</h3>
                    <h5>Chọn phương thức thanh toán</h5>
                    <form action="" method="GET" class="select-banking">
                        <a href="" class="banking" title="Ví điện tử Momo" onclick="select(event)"><img src="{{asset('assets/img/momo.png')}}" alt="momo"></a>
                        <a href="" class="banking" title="Ngân hàng MBank" onclick="select(event)"><img src="{{asset('assets/img/mbbank.png')}}" alt="mbbank"></a>
                        <a href="" class="banking" title="Ngân hàng Vietcombank" onclick="select(event)"><img src="{{asset('assets/img/vietcombank.png')}}" alt="vietcombank"></a>
                        <a href="" class="banking action-select-banking" title="Thanh toán sau khi nhận hàng" onclick="select(event)"><img src="{{asset('assets/img/home-bank.png')}}" alt="home-bank"></a>
                        <script>
                            function select(event) {
                                event.preventDefault();
                                const radio = document.querySelectorAll('.banking');
                                radio.forEach(input => {
                                    input.classList.remove('action-select-banking')
                                });  
                                event.currentTarget.classList.add('action-select-banking');
                                document.getElementById('payment-method').innerHTML = event.currentTarget.title
                            }
                        </script>
                    </form>
                </div>
            </div>
            <div class="footer">
                <h3>Tổng tiền: <span class="total-number">{{$sum_total  }}</span> <span>VNĐ</span></h3>
                <h3>Phương thức thanh toán: <span style="color: red" id="payment-method">Thanh toán sau khi nhận hàng</span></h3>
                <a href="" class="btn btn-order">Đặt hàng</a>
            </div>
        </div>
    </div>
    @include('layouts.user.footer')
@endsection