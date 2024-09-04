@extends('layouts.user')
@push('head')
    <link rel="shortcut icon" href="{{asset('assets/user/img/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/user/css/product-id.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/product.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/swaper.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <title>Sản phẩm</title>
@endpush

@section('content')
    @include('layouts.user.header')
    <div class="back">
        <a href="{{ $url_back }}"> <i class="fa-solid fa-arrow-left"></i> Quay lại</a>
    </div>
    <div id="container">
        <div class="data-table">
            <div class="information-product">
                <div class="images-product">
                    <div class="img-main">
                        <img src=" {{ $product->image[0] }} " alt="">
                    </div>
                    <div class="sub-img">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @for ($i = 1; $i < count($product->image); $i++)
                                    <div class="swiper-slide"><a href="#"><img src="{{ $product->image[$i] }}" alt="promotion-program"></a></div>
                                @endfor
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                        <script>
                            const swiper = new Swiper('.swiper-container', {
                                spaceBetween: 10,
                                loop: true, // Cho phép vòng lặp qua các slide
                                slidesPerView: 2, // Hiển thị 2 slide cùng lúc
                                centeredSlides: true, // Đặt slide đang xem ở giữa
                                slidesPerGroup: 1, // Di chuyển từng slide một
                                pagination: {
                                    el: '.swiper-pagination',
                                    clickable: true,
                                },
                                navigation: {
                                    nextEl: '.swiper-button-next',
                                    prevEl: '.swiper-button-prev',
                                },
                                autoplay: {
                                    delay: 1000,
                                    disableOnInteraction: false,
                                },
                            });
            
                        </script>
                    </div>
                </div>
                <div class="information">
                    <h1 id="title title_product">Thông tin sản phẩm</h1>
                    <h2 class="product_name">{{ $product->product_name }}</h2>
                    <p class="price" name='price'> Giá: {{ $product->price }} <span class="sale" style="color: red"></span> VNĐ </p>
                    <p class="product_code"> Mã sản phẩm: {{ $product->product_code }} </p>
                    <p class="information_id"> Thông tin sản phẩm </p>
                    <p class=""> Màu sắc: Đen, Trắng, Xám </p>
                    <p class=""> Kích thước: S, M, L, XL </p>
                    <div class="quantity">
                        <span>Số lượng</span>
                        <div class="quantity-func">
                            <a href="#" onclick="decrease(event)"><i class="fa-solid fa-minus increase"></i></a>
                            <span class="quantity-product-buy" name="quantity-product-buy"> 19 </span>
                            <a href="#" onclick="increase(event)"><i class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="button-action">
                        <a href="#" class="btn btn-buy">Mua ngay</a>
                        <a href="#" class="btn btn-cart">Thêm vào giỏ hàng</a>
                    </div>
                </div>
            </div>
            <div class="details-product" >
                <h1 id="title title_product">Thông tin chi tiết</h1>
                <ul class="detail">
                    @foreach ($product->description as $item)
                        <li>{{$item}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="header" style="margin: 20px auto;">
            <div class="title"><h1>Sản phẩm khác có thể bạn sẽ thích</h1></div>
        </div>
        <div class="list-products">
            <div class="products">
                @for ($i = 0; $i < 10; $i++)
                <div class="product">
                    <a href="#" class="image" style="width: 100%">
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
                @endfor
            </div>
        </div>
        <div class="seen-product">
            <a href="#" class="seen">Xem thêm</a>
        </div>
    </div>
    @include('layouts.user.footer')
@endsection 