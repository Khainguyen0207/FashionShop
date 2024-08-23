@extends('layouts.user')
@push('head')
@push('head')
    <link rel="shortcut icon" href="{{asset('assets/user/img/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/cart.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    
    <title>Giỏ hàng</title>
@endpush
@endpush
@section('content')
    @include('layouts.user.header')
    <div id="container">
        <div class="list-products">
            <div class="products">
                <div class="product">
                    <a href="" class="image" style="width: 100%">
                        <img class="img img-product-sale" src="{{asset('assets/user/img/box.png')}}" alt="review">
                        <div class="animation-img">
                            <p style="color: black">Chi tiết sản phẩm</p>
                        </div>
                    </a>
                    <div class="informations information-product ">
                        <div class="truncate-1"><p class="product_name">Áo thun gấu</p> </div>
                        <p class="sale-price">129.000 VNĐ</p>
                    </div>
                    <a href="#" class="btn btn-buy" style="margin-bottom: 5px;">Mua ngay</a>
                    <a href="#" class="btn btn-cart" >Thêm vào giỏ hàng</a>
                </div>  
            </div>
        </div>
        <div class="pay">
            
        </div>
    </div>
    @include('layouts.user.footer')
@endsection