@extends('layouts.user')

@push('head')
    <link rel="stylesheet" href="{{asset('assets/user/css/home.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/swaper.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <title>Trang chủ</title>
@endpush

@section('content')
    @php
        $banner = getBanner();
    @endphp
    @include('layouts.user.header')
    <div id="container">
        <div class="nav-bar interview">
            <h2 class="title"  style="margin-bottom: 10px;">Danh mục</h2>
            <div class="list-bar">
                <div class="small-bar">
                    <a href="#footer" style="text-decoration: none;">
                        <img src="{{asset('assets/user/img/box.png')}}" alt="review">
                        <p class="content-bar">Giới thiệu</p>   
                    </a>
                </div>
                <div class="small-bar">
                    <a href="#products" style="text-decoration: none;">
                        <img src="{{asset('assets/user/img/products.png')}}" alt="products">
                        <p class="content-bar">Sản phẩm</p>
                    </a>
                </div>
                <div class="small-bar">
                    <a href="#sale" style="text-decoration: none;">
                        <img src="{{asset('assets/user/img/sale.png')}}" alt="">
                        <p class="content-bar">Khuyến mãi</p>
                    </a>
                </div>
                <div class="small-bar">
                    <a href="#footer" style="text-decoration: none;">
                        <img src="{{asset('assets/user/img/contact.png')}}" alt="">
                        <p class="content-bar">Liên hệ</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="shop-banner">
            @if ($banner['banner'])
                <a href="/"><img style="width: 100%;max-height: 70vh;object-fit: contain;border-radius: 10px;" src="{{ $banner['banner'] }}" alt="logo"></a>
            @else
                <a href="/"><img style="width: 100%;max-height: 70vh;object-fit: contain;border-radius: 10px;" src="{{asset('assets/user/img/banner-shop.png')}}" class="image-banner" alt="banner-shop"></a>
            @endif
        </div>
        <div class="promotions">
            <div class="promotion">
                <h2>Khuyến mãi</h2>
                <div class="img img-promotion">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($events as $item)
                                <div class="swiper-slide">
                                    <a href="#"><img src="{{ url(Storage::url($item['image'])) }}" alt="promotion-program"></a>
                                </div>
                            @endforeach
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                    </div> 
                </div>
            </div>

            <div class="events-new_products">
                <div class="new-products">
                    <h2>Sản phẩm mới</h2>
                    <div class="img img-new-product">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ($products_new as $item)
                                <div class="swiper-slide">
                                    <a href="{{ route('product.id', [$item->category_id , $item->id]) }}"><img src="{{ $item['image'][0] }}" alt="promotion-program"></a>
                                </div>
                                @endforeach
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>  
                    </div>
                </div>
                <div class="events">
                    <h2>Sự kiện</h2>
                    <div class="img img-events">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ($events as $item)
                                <div class="swiper-slide">
                                    <a href="{{route("user.event.show", ['title_blog' => $item['title'], 'id' => $item['id']])}}"><img src="{{ url(Storage::url($item['image'] )) }}" alt="promotion-program"></a>
                                </div>
                                @endforeach
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>  
                    </div>
                </div>
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

        <div class="nav-bar sale" id="sale">
            <div class="tittle" style="display: inline-block;margin-bottom: 10px;">
                <h2>Giảm giá <span style="color:red; font-size: 14px;" id="time-sale">Thời gian: </span></h2>
                <script>
                    setInterval(() => {
                        const time = new Date();
                        var time_date = time.getDate() + "/" + time.getMonth() + "/" + time.getFullYear();
                        var time_real = time.getHours() + "-" + time.getMinutes() + "-" + time.getSeconds();
                        document.getElementById('time-sale').innerHTML = "Thời gian: " + time_date +"   " +time_real;
                    }, 1000);
                </script>
            </div>
            <div class="list-products-sale">
                <div class="products-sale">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="product-sale">
                            <a href="" class="image" style="width: 100%">
                                <img class="img img-product-sale" src="{{asset('assets/user/img/box.png')}}" alt="review">
                                <div class="animation-img">
                                    <p style="color: black">Chi tiết sản phẩm</p>
                                </div>
                            </a>
                            <div class="informations information-product-sale ">
                                <div class="truncate-1"><p class="product_name">Áo thun gấu</p> </div>
                                <p class="sale-price">129.000 - <span class="price" style="text-decoration: line-through; color: red;"> 200.000 VNĐ</span></p>
                            </div>
                            <div class="action">
                                <a href="" class="btn btn-buy">Mua ngay</a>
                                <a href="#" class="btn btn-cart">Thêm vào giỏ hàng</a>
                            </div>
                        </div>  
                    @endfor
                </div>
            </div>
            <div class="info" style="display: block; float: right;">
                <a href="#" style="text-decoration: none; color: black;">Xem thêm <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="products" id="products">
            @foreach ($categories as $category)
                @if (!empty($category['products']))
                <div class="nav-bar">
                    <div class="tittle" style="display: inline-block;margin-bottom: 10px;">
                        <h2> {{ $category['name_category'] }} </h2>
                    </div>
                    <div class="list-products">
                        <div class="products">
                            @foreach ($category['products'] as $product)
                                <div class="product">
                                    <a href="{{ route('product.id', [$product->category_id , $product->id]) }}" class="image" style="width: 100%">
                                        <img class="img img-product-sale" src="{{ $product['image'][0] }}" alt="review">
                                        <div class="animation-img">
                                            <p style="color: black">Chi tiết sản phẩm</p>
                                        </div>
                                    </a>
                                    <div class="informations information-product ">
                                        <div class="truncate-1"><p class="product_name">{{ $product['product_name'] }}</p> </div>
                                        <p class="sale-price">{{ number_format($product['price'], 0, ",", ".") }} VNĐ</p>
                                    </div>
                                    <div class="action">
                                        <a href="{{ route("user.cart.home") }}" class="btn btn-buy"  data-url="{{ route('user.cart.post', $product->id) }}">Mua ngay</a>
                                        <a href="#" class="btn btn-cart" data-url="{{ route('user.cart.post', $product->id) }}">Thêm vào giỏ hàng</a> 
                                    </div>    
                                </div>
                            @endforeach
                            
                        </div>
                        <div class="info" style="display: block; float: right;">
                            <a href="{{ route('products.id', $category['id'] )}}" style="text-decoration: none ; color: black;">Xem thêm <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>       
                @endif
            @endforeach
        </div>
    </div>
    @include('layouts.user.footer')
    <footer>
        <script src="{{ asset('assets/js/cart.js') }}"></script>
        <script>
            seen()
        </script>
    </footer>
@endsection