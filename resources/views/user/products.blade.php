@extends('layouts.user')
@push('head')
    <link rel="shortcut icon" href="{{asset('assets/user/img/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/user/css/product.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <title>Sản phẩm</title>
@endpush

@section('content')
    @include('layouts.user.header')
    <div id="hide_option">
        <div class="hide_option_hidden">
            <div class="screen"></div>
            <div class="select_type">
                <h1 id="title title_product">Thông tin sản phẩm</h1>
                <h2 class="product_name"></h2>
                <p> Giá: <span class="price" name="price"></span> <span class="sale" style="color: red"></span></p>
                
                <p class="">Chọn màu sắc
                    <div class="type color">
                        <a href="#" class="information_btn btn_color">Đen</a>
                        <a href="#" class="information_btn btn_color">Trắng</a>
                        <a href="#" class="information_btn btn_color">Xám</a>
                    </div> 
                <p>
                <p class=""> Chọn kích thước
                    <div class="type size">
                        <a href="#" class="information_btn btn_size">S</a>
                        <a href="#" class="information_btn btn_size">M</a>
                        <a href="#" class="information_btn btn_size">L</a>
                        <a href="#" class="information_btn btn_size">XL</a>
                    </div> 
                <p>
                <div class="button-action">
                    <a href="#" class="btn btn-cancel" onclick="event.preventDefault(); document.querySelector('.screen').click();">Hủy</a>
                    <a href="" id="cart" class="btn btn-cart" onclick="addCart(event)" data-option="">Thêm vào giỏ hàng</a>
                </div>
            </div>
        </div>  
        <script>
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
                    color = document.querySelector(`.btn_color.action`)
                    size = document.querySelector(`.btn_size.action`)

                    if (color !== null && size !== null) {
                        url = button.getAttribute("data-option");
                        button.setAttribute("data-option", `color=${color.text}&size=${size.text}`);
                    }
                });
            });
        </script>
    </div>
    <div id="container">
        <div class="header">
            <div class="title"><h1>{{ $category_name }}</h1></div>
            <div class="fill">
                <a href="#" class="fill-item" onclick="update(event)" data-url="{{ route("products.home.arrange", ['arrange' => 'asc']) }}">Giá thấp->cao <i class="fa-solid fa-arrow-down-short-wide"></i></a>
                <a href="#" class="fill-item" onclick="update(event)" data-url="{{ route("products.home.arrange", ['arrange' => 'desc']) }}">Giá cao->thấp <i class="fa-solid fa-arrow-down-wide-short"></i></a>
                <a href="#" class="fill-item" onclick="update(event)" data-url="{{ route("products.home.arrange", ['arrange' => 'buy_much']) }}">Mua nhiều <i class="fa-solid fa-sort"></i></a>
            </div>
        </div>
        <div id="hidden-list">
            @if (count($products) > 0)
                @include("layouts.user.list-products")
            @else
                <h3 style="padding: 10px 0">Sản phẩm hiện không có sẵn</h3>
            @endif
        </div>
        <div class="events-vouchers" id="sale">
            <div class="events">
                <h2 style="margin-bottom: 5px;">Sự kiện giảm giá cô bé quàng khăn đỏ</h2>
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
    </div>
    @include('layouts.user.footer')
    <footer>
        <script src="{{asset('assets/user/js/products.js')}}"></script>
        <script>cart()</script>
    </footer>
@endsection