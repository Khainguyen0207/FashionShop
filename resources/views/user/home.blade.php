@extends('layouts.user')

@push('head')
    <link rel="shortcut icon" href="{{asset('assets/user/img/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/user/css/home.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@endpush

@section('content')
    <div id="header">
        <a href="#"><img src="{{asset('assets/user/img/logo.png')}}" alt="logo"></a>
        <div class="bar">
            <a href="#" class="cart"><i class="fa-solid fa-cart-shopping" ></i> Giỏ hàng</a>
            <a href="{{route('admin.logout')}}" class="login"><i class="fa-solid fa-user"></i> Đăng xuất</a>
        </div>
    </div>
    <div id="menu-bar">
        <div class="menu">
            <li class="content-menu"><a href="#"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
            <li class="content-menu"><a href="#products"><i class="fa-solid fa-box-open"></i> Sản phẩm</a></li>
            <li class="content-menu"><a href="#sale"><i class="fa-solid fa-ticket"></i> Khuyến mãi</a></li>
            <li class="content-menu"><a href="#footer"><i class="fa-solid fa-headset"></i> Liên hệ</a></li>
        </div>
        <div class="search">
            <i class="icon fa-solid fa-magnifying-glass"></i>
            <input type="search" name="search" placeholder="Tìm kiếm"> 
        </div>
    </div>
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
            <img src="{{asset('assets/user/img/banner-shop.png')}}" class="image-banner" alt="banner-shop">
        </div>

        <div class="promotions">
            <div class="promotion">
                <h2>Chương trình khuyến mãi</h2>
                <div class="img img-promotion">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><a href="#"><img src="{{asset('assets/user/img/event-0.png')}}" alt="promotion-program"></a></div>
                            <div class="swiper-slide"><a href="#"><img src="{{asset('assets/user/img/event-1.png')}}" alt="promotion-program"></a></div>
                            <div class="swiper-slide"><a href="#"><img src="{{asset('assets/user/img/event-2.png')}}" alt="promotion-program"></a></div>
                            <div class="swiper-slide"><a href="#"><img src="{{asset('assets/user/img/event-3.png')}}" alt="promotion-program"></a></div>
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
                                <div class="swiper-slide"><a href="#"><img src="{{asset('assets/user/img/event-0.png')}}" alt="promotion-program"></a></div>
                                <div class="swiper-slide"><a href="#"><img src="{{asset('assets/user/img/event-1.png')}}" alt="promotion-program"></a></div>
                                <div class="swiper-slide"><a href="#"><img src="{{asset('assets/user/img/event-2.png')}}" alt="promotion-program"></a></div>
                                <div class="swiper-slide"><a href="#"><img src="{{asset('assets/user/img/event-3.png')}}" alt="promotion-program"></a></div>
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>  
                    </div>
                </div>
                <div class="events">
                    <h2>Sự kiện và voucher</h2>
                    <div class="img img-events">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide"><a href="#"><img src="{{asset('assets/user/img/event-0.png')}}" alt="promotion-program"></a></div>
                                <div class="swiper-slide"><a href="#"><img src="{{asset('assets/user/img/event-1.png')}}" alt="promotion-program"></a></div>
                                <div class="swiper-slide"><a href="#"><img src="{{asset('assets/user/img/event-2.png')}}" alt="promotion-program"></a></div>
                                <div class="swiper-slide"><a href="#"><img src="{{asset('assets/user/img/event-3.png')}}" alt="promotion-program"></a></div>
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
                        console.log(time_date +"    " +time_real);
                        document.getElementById('time-sale').innerHTML = "Thời gian: " + time_date +"   " +time_real;
                    }, 1000);
                </script>
            </div>
            <div class="list-products-sale">
                <div class="products-sale">
                    <div class="product-sale">
                        <a href=""><img class="img img-product-sale" src="{{asset('assets/user/img/box.png')}}" alt="review"></a>
                        <div class="informations information-product-sale ">
                            <div class="truncate-1"><p class="product_name">Áo thun gấu</p> </div>
                            <p class="sale-price">129.000 - <span class="price" style="text-decoration: line-through; color: red;"> 200.000 VNĐ</span></p>
                        </div>
                        <a href="#" class="btn btn-buy" style="margin-bottom: 5px;">Mua ngay</a>
                        <a href="#" class="btn btn-cart" >Thêm vào giỏ hàng</a>
                    </div>  
                    <div class="product-sale">
                        <img class="img img-product-sale" src="{{asset('assets/user/img/box.png')}}" alt="review">
                        <div class="informations information-product-sale ">
                            <div class="truncate-1"><p class="product_name">Áo thun gấu</p> </div>
                            <p class="sale-price">129.000 - <span class="price" style="text-decoration: line-through; color: red;"> 200.000 VNĐ</span></p>
                        </div>
                        <a href="#" class="btn btn-buy" style="margin-bottom: 5px;">Mua ngay</a>
                        <a href="#" class="btn btn-cart" >Thêm vào giỏ hàng</a>
                    </div>  
                    {{-- Thêm sản phẩm --}}
                </div>
            </div>
            <div class="info" style="display: block; float: right;">
                <a href="#" style="text-decoration: none; color: black;">Xem thêm <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="products" id="products">
            <div class="nav-bar man" onclick="alert('hello')">
                <div class="tittle" style="display: inline-block;margin-bottom: 10px;">
                    <h2> Thời trang nam </h2>
                </div>
                <div class="list-products">
                    <div class="products">
                        <div class="product">
                            <a href=""><img class="img img-product-sale" src="{{asset('assets/user/img/box.png')}}" alt="review"></a>
                            <div class="informations information-product ">
                                <div class="truncate-1"><p class="product_name">Áo thun gấu</p> </div>
                                <p class="sale-price">129.000 VNĐ</p>
                            </div>
                            <a href="#" class="btn btn-buy" style="margin-bottom: 5px;">Mua ngay</a>
                            <a href="#" class="btn btn-cart" >Thêm vào giỏ hàng</a>
                        </div>  
                    </div>
                    <div class="info" style="display: block; float: right;">
                        <a href="#" style="text-decoration: none ; color: black;">Xem thêm <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="nav-bar woman">
                <div class="tittle" style="display: inline-block;margin-bottom: 10px;">
                    <h2>Thời trang nữ</h2>
                </div>
                <div class="list-products">
                    <div class="products">
                        <div class="product">
                            <a href=""><img class="img img-product-sale" src="{{asset('assets/user/img/box.png')}}" alt="review"></a>
                            <div class="informations information-product ">
                                <div class="truncate-1"><p class="product_name">Áo thun gấu</p> </div>
                                <p class="sale-price">129.000 VNĐ</p>
                            </div>
                            <a href="#" class="btn btn-buy" style="margin-bottom: 5px;">Mua ngay</a>
                            <a href="#" class="btn btn-cart" >Thêm vào giỏ hàng</a>
                        </div>  
                    </div>
                    <div class="info" style="display: block; float: right;">
                        <a href="#" style="text-decoration: none; color: black;">Xem thêm <i class="fa-solid fa-arrow-right"></i></a>
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