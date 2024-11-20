@extends('layouts.user')
@push('head')
    <link rel="stylesheet" href="{{asset('assets/user/css/product-id.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/product.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/swaper.css')}}">
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
                    <p class="price" name='price'> Giá: <span class="price_num">{{ number_format($product->price, 0, ",", ".") }}</span> <span class="sale" style="color: red"></span> VNĐ </p>
                    <p class="product_code"> Mã sản phẩm: {{ $product->product_code }} </p>
                    <p class="information_id"> Thông tin sản phẩm </p>
                    <div class="select_type">
                        <p class="">Chọn màu sắc
                            <div class="type color">
                                @foreach (json_decode($product->colors, true) as $key_color => $value_color)
                                    <a href="#" class="information_btn btn_color" data-value="{{ $value_color }}">{{$key_color}}</a>
                                @endforeach
                            </div> 
                        </p>
                        <p class=""> Chọn kích thước
                            <div class="type size">
                                @foreach (json_decode($product->sizes, true) as $key_size => $value_size)
                                    <a href="#" class="information_btn btn_size" data-value="{{ $value_size }}">{{ $key_size }}</a>
                                @endforeach
                            </div> 
                        </p>
                    </div>
                    <div class="button-action">
                        <a href="{{route("user.cart.home")}}" class="btn btn-buy " style="margin-bottom: 5px;" data-url="{{ route('user.cart.post', $product->id) }}">Mua ngay</a>
                        <a href="#" id="cart" class="btn btn-cart" data-url="{{ route('user.cart.post', $product->id) }}" data-option="">Thêm vào giỏ hàng</a>
                    </div>
                    <script>
                        const formatter = new Intl.NumberFormat('vi-VN', {
                            style: 'decimal',
                            currency: 'VND'
                        });
                        const price_num = document.querySelector(".information").querySelector(".price_num").textContent;
                        btn_sizes = document.querySelectorAll('.information_btn'); //Sự kiện click button_buy
                        btn_sizes.forEach(element => {
                            element.addEventListener('click', function(event) {
                                event.preventDefault();
                                let classname = event.currentTarget.classList[1]
                                document.querySelectorAll(`.${classname}`).forEach(element_del => {
                                    element_del.classList.remove("action")
                                });
                                element.classList.add("action");
                                const button = document.querySelector("#cart");
                                const color = document.querySelector('.btn_color.action')?.textContent ?? "";
                                const size = document.querySelector('.btn_size.action')?.textContent ?? "";
                                let information = document.querySelector(".information");
                                url = button.getAttribute("data-option");
                                let price = parseInt(price_num.replace(/\./g, ""));
                                let num = 0;
                                information.querySelectorAll(".action").forEach(element => {
                                    num += parseInt(element.dataset.value)
                                });
                                information.querySelector(".price_num").innerHTML = formatter.format(price + num);
                                let price_n = information.querySelector(".price_num").textContent.replace(/\./g, '')
                                button.setAttribute("data-option", `color=${color}&size=${size}&price=${price_n}`);
                            });
                        });
                    </script>
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
        <div id="hidden-list">
            @if (count($products) > 0)
                @include("layouts.user.list-products")
            @else
                <h3 style="padding: 10px 0">Sản phẩm hiện không có sẵn</h3>
            @endif
        </div>
    </div>
    @include('layouts.user.footer')
    <footer>
        <script src="{{ asset('assets/js/cart.js') }}"></script>
        <script>seen()</script>
    </footer>
@endsection