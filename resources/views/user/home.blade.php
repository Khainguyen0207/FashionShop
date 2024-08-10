@extends('layouts.user')

@push('head')
    <link rel="shortcut icon" href="{{asset('assets/user/img/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/user/css/home.css')}}">
@endpush

@section('content')
    <div id="header">
        <a href="#"><img src="{{asset('assets/user/img/logo.png')}}" alt="logo"></a>
        <div class="bar">
            <a href="#" class="cart"><i class="fa-solid fa-cart-shopping" ></i> Giỏ hàng</a>
            <a href="#" class="login"><i class="fa-solid fa-user"></i> Đăng nhập</a>
        </div>
    </div>
    <div id="container">
        <div class="menu-bar">
            <div class="menu">
                <li class="content-menu"><a href="#home"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
                <li class="content-menu"><a href="#product"><i class="fa-solid fa-box-open"></i> Sản phẩm</a></li>
                <li class="content-menu"><a href="#sale"><i class="fa-solid fa-ticket"></i> Khuyến mãi</a></li>
                <li class="content-menu"><a href="#contact"><i class="fa-solid fa-headset"></i> Liên hệ</a></li>
            </div>
            <div class="search">
                <i class="icon fa-solid fa-magnifying-glass"></i>
                <input type="search" name="search" placeholder="Tìm kiếm ..."> 
            </div>
        </div>
    </div>
    <div id="content">
        <div class="nav-bar">
            <h2 class="title"  style="margin-bottom: 10px;">Danh mục</h2>
            <div class="list-bar">
                <div class="small-bar">
                    <a href="#" style="text-decoration: none;">
                        <img src="{{asset('assets/user/img/box.png')}}" alt="review">
                        <p class="content-bar">Giới thiệu</p>   
                    </a>
                </div>
                <div class="small-bar">
                    <a href="#" style="text-decoration: none;">
                        <img src="{{asset('assets/user/img/products.png')}}" alt="products">
                        <p class="content-bar">Sản phẩm</p>
                    </a>
                </div>
                <div class="small-bar">
                    <a href="#" style="text-decoration: none;">
                        <img src="{{asset('assets/user/img/sale.png')}}" alt="">
                        <p class="content-bar">Khuyến mãi</p>
                    </a>
                </div>
                <div class="small-bar">
                    <a href="#" style="text-decoration: none;">
                        <img src="{{asset('assets/user/img/contact.png')}}" alt="">
                        <p class="content-bar">Liên hệ</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="shop-banner">
            <img src="{{asset('assets/user/img/banner-shop.png')}}" class="image-banner" alt="banner-shop">
        </div>

        <div class="promotions">
            <div class="promotion">
                <h2>Chương trình khuyến mãi</h2>
                <div class="img img-promotion">
                    <a href="#"><img src="{{asset('assets/user/img/event-0.png')}}" alt="promotion-program"></a>
                </div>
            </div>
            <div class="events-new_products">
                <div class="new-products">
                    <h2>Sản phẩm mới</h2>
                    <div class="img img-new-products">
                        <a href="#"><img src="{{asset('assets/user/img/event-1.png')}}" alt="new-product"></a>
                        <a href="#"><img src="{{asset('assets/user/img/event-2.png')}}" alt="events"></a>
                    </div>
                </div>
                <div class="events">
                    <h2>Sự kiện và voucher</h2>
                    <div class="img img-events">
                        <a href="#"><img src="{{asset('assets/user/img/event-2.png')}}" alt="events"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
        <h1>Giới thiệu</h1>
        <li>FashionStore tự hào mang đến những sản phẩm thời trang chất lượng cao với xu hướng mới nhất từ khắp nơi trên thế giới. Phong cách và đẳng cấp, tất cả đều có tại FashionStore.</li>
        <div class="social-networking-contact">
            <div class="social-networking">
                <h1>Mạng xã hội</h1>
                <li>FB: <a href="#">facebook.com/supportfashionstore</a></li>
                <li>Tiktok: <a href="#">@supportfashionstore</a></li>
                <li>IG: <a href="#">@supportfashionstore</a></li>
            </div>
            <div class="contact">
                <h1>Liên hệ </h1>
                <li>Hotline: <a href="#">(+84) 123 456 789</a></li>
                <li>Email: <a href="#">supportfashionstore@support.vn</a></li>
                <li>Địa chỉ: 123 Đường Thời Trang, Quận 1, TP. Hồ Chí Minh</li>
            </div>
        </div>
        <h1>Cảm ơn</h1>
            <li>Cảm ơn quý khách đã ghé thăm và mua sắm tại FashionStore. Chúng tôi luôn nỗ lực để mang đến cho quý khách trải nghiệm mua sắm tốt nhất!</li>
        <p style="display:block;color: gray;float:right;">@Bản quyền thuộc về Fashionstore</p>
    </div>
@endsection