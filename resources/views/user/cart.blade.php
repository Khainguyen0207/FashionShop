@extends('layouts.user')
@push('head')
    <link rel="shortcut icon" href="{{asset('assets/user/img/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/cart.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    
    <title>Giỏ hàng</title>
@endpush
@section('content')
    @include('layouts.user.header')
    <div id="container">
        <div class="products">
            <h1 style="border-bottom: 2px lightgray solid;">Giỏ hàng</h1>
            @for ($i = 0; $i < 1; $i++)
                <div class="product">
                    <input style="width: 10%;max-width: 30px;" type="checkbox" name="select-product" id="select-product">
                    <a href="?id=1" class="image">
                        <img class="img img-product-sale" src="{{asset('assets/user/img/box.png')}}" alt="review">
                        <div class="animation-img">
                            <p style="color: black">Chi tiết sản phẩm</p>
                        </div>
                    </a>
                    <div class="informations information-product">
                        <div class="truncate-1"><p class="product_name">Tên sản phẩm: Áo thun gấu</p> </div>
                        <div class="product_code"><p class="product_code">Mã sản phẩm: RYBC34</p> </div>
                        <p class="sale-price">Giá:  129.000 - <span class="price" style="text-decoration: line-through; color: red;">200.000 VNĐ</span></p>
                        <div class="quantity">
                            <span>Số lượng:</span>
                            <div class="quantity-func">
                                <a href="?" onclick="decrease(event)"><i class="fa-solid fa-minus increase"></i></a>
                                <span class="quantity-product-buy" name="quantity-product-buy"> 19 </span>
                                <a href="?" onclick="increase(event)"><i class="fa-solid fa-plus"></i></a>
                            </div>
                        </div>
                        <p class="total">Thành tiền:  129.000 VNĐ</p>
                        <a href="?product" class="seen-product">Xem chi tiết sản phẩm</a>
                    </div>
                </div>
            @endfor
        </div>
        <div class="pay">
            <div class="header">
                <h1>Hóa đơn sản phẩm</h1>
            </div>
            <div class="content">
                <div class="product-add">
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
                <div class="total-amount">
                    <h3>Thành tiền</h3>
                    <h3>300.000 VNĐ</h3>
                </div>
            </div>
            <div class="footer">
                <a href="#" class="btn btn-voucher" style="margin-bottom: 5px;">Voucher giảm giá</a>
                <a href="{{route('user.pay.home')}}" class="btn btn-pay">Thanh toán</a>
            </div>
        </div>
    </div>
    @include('layouts.user.footer')
@endsection