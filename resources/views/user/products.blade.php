@extends('layouts.user')
@push('head')
    <link rel="shortcut icon" href="{{asset('assets/user/img/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/user/css/product.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <title>Sản phẩm</title>
@endpush

@section('content')
    @include('layouts.user.header')
    <div id="container">
        <div class="header">
            <div class="title"><h1>{{ $category_name }}</h1></div>
            <div class="fill">
                <a href="#" class="fill-item">Giá thấp ->cao <i class="fa-solid fa-arrow-down-short-wide"></i></a>
                <a href="#" class="fill-item"> Giá cao->thấp <i class="fa-solid fa-arrow-down-wide-short"></i></a>
                <a href="#" class="fill-item">Mua nhiều <i class="fa-solid fa-sort"></i></a>
            </div>
        </div>
        <div id="hidden-list">
            <div class="list-products">
                <div class="products">
                    @foreach ($products as $product)
                        <div class="product">
                            <a href="{{ route('product.id', [$product->category_id , $product->id]) }}" class="image" style="width: 100%">
                                <img class="img img-product-sale" src="{{ $product->image[0] }}" alt="review">
                                <div class="animation-img">
                                    <p style="color: black">Chi tiết sản phẩm</p>
                                </div>
                            </a>
                            <div class="informations information-product ">
                                <div class="truncate-1"><p class="product_name">{{ $product->product_name }}</p> </div>
                                <p class="sale-price">{{ $product->price }} VNĐ</p>
                            </div>
                            <a href="#" class="btn btn-buy" style="margin-bottom: 5px;">Mua ngay</a>
                            <a href="" class="btn btn-cart" data-url="{{ route('user.cart.post', $product->id) }}">Thêm vào giỏ hàng</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="seen-product">
                @if ((count($products) / 10) < $max_page)
                    <a href="#" id="load_products" onclick="update(event)" data-url="{{ $url }}" class="seen">Xem thêm</a> 
                @endif
            </div>
        </div>
        <div class="events-vouchers">
            <div class="events">
                <h2 style="margin-bottom: 5px;">Mua sắm thả ga cùng sự kiện giảm giá cực sốc</h2>
                <a href="#" class="event-link">
                    <video class="img img-product-sale" autoplay muted loop>
                        <source src="{{ asset('assets/user/video/videoplayback.webm') }}" type="video/mp4">
                    </video>
                </a>
            </div>
            <div class="content" style="margin: 10px;">
                <p class="seen">Nhận ngay vouchers giảm giá đến 50% khi tham gia sự kiện cùng cô bé quàng khăn đỏ nào <a href="?hi" style="color: red">Đến ngay</a></p>   
            </div>
        </div>
        <div id="other-products">
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
                        <a href="#" class="btn btn-cart">Thêm vào giỏ hàng</a>
                    </div>  
                    @endfor
                </div>
            </div>
        </div>
        <div class="seen-product">
            <a href="#" class="seen">Xem thêm</a>
        </div>
    </div>
    @include('layouts.user.footer')
    <footer>
        <script src="{{asset('assets/user/js/products.js')}}"></script>
        <script src="{{ asset('assets/js/cart.js') }}"></script>
        <script>
             seen()
        </script>
    </footer>
@endsection