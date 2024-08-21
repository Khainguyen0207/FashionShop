@extends('layouts.user')
@push('head')
    <link rel="shortcut icon" href="{{asset('assets/user/img/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/user/css/product-id.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/product.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <title>Sản phẩm</title>
@endpush

@section('content')
    @include('layouts.user.header')
    <div class="back">
        <a href="{{route('products.home')}}"> <i class="fa-solid fa-arrow-left"></i> Quay lại</a>
    </div>
    <div id="container">
        <div class="data-table">
            <div class="information-product">
                <div class="images-product">
                    <div class="img-main">
                        <img src="{{asset('assets/user/img/box.png')}}" alt="">
                    </div>
                    <div class="sub-img">
                        @for ($i = 0; $i < 2; $i++)
                            <img src="{{asset('assets/user/img/box.png')}}" alt="">
                        @endfor
                    </div>
                </div>
                <div class="information">
                    <h1 id="title title_product">Thông tin sản phẩm</h1>
                    <h2 class="product_name">Áo ba lỗ thể thao</h2>
                    <p class="price" name='price'> Giá: 199.000  -  100.000 VNĐ - Giảm giá 20%</p>
                    <p class="product_code"> Mã sản phẩm: XL932-o2 </p>
                    <p class="information_id"> Thông tin sản phẩm </p>
                    <p class=""> Màu sắc: Đen, Trắng, Xám </p>
                    <p class=""> Kích thước: S, M, L, XL </p>
                    <div class="quantity">
                        <span>Số lượng</span>
                        <div class="quantity-func">
                            <a href="?" onclick="decrease(event)"><i class="fa-solid fa-minus increase"></i></a>
                            <span class="quantity-product-buy" name="quantity-product-buy"> 19 </span>
                            <a href="?" onclick="increase(event)"><i class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="button-action">
                        <a href="" class="btn btn-buy">Mua ngay</a>
                        <a href="" class="btn btn-cart">Thêm vào giỏ hàng</a>
                    </div>
                </div>
            </div>
            <div class="details-product" >
                <h1 id="title title_product">Thông tin chi tiết</h1>
                <ul class="detail">
                    <li><strong>Kiểu dáng:</strong> Đơn giản, ôm sát cơ thể, cổ tròn</li>
                    <li><strong>Chất liệu:</strong> 100% Cotton thoáng mát, thấm hút mồ hôi</li>
                    <li><strong>Đặc điểm nổi bật:</strong>
                        <ul style="list-style: none;margin-left:20px;">
                            <li>Thiết kế trẻ trung, năng động</li>
                            <li>Chất liệu vải co giãn, thoáng mát</li>
                            <li>Đường may chắc chắn, tỉ mỉ</li>
                            <li>Thích hợp cho các hoạt động thể thao hoặc mặc hàng ngày</li>
                        </ul>
                    </li>
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
                @endfor
            </div>
        </div>
        <div class="seen-product">
            <a href="#" class="seen">Xem thêm</a>
        </div>
    </div>
    @include('layouts.user.footer')
@endsection 