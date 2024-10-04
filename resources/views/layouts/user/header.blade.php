<div id="header">
    <a href="#"><img src="{{asset('assets/user/img/logo.png')}}" alt="logo"></a>
    <div class="bar">
        <a href="{{route('user.cart.home')}}" class="cart"><i class="fa-solid fa-cart-shopping" ></i> Giỏ hàng</a>
        <div class="login">
            @if (Auth::check())
                <a href="#"><i class="fa-solid fa-user"></i> Người dùng</a>
                <ul class="nav">
                    <li><a href="{{route("profile.home")}}"><i class="fa-solid fa-info"></i> Thông tin</a></li>
                    <li><a href="#" onclick="document.getElementById('logout').submit()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng xuất</a></li>
                </ul>
            @else
                <a href="{{route("login")}}"><i class="fa-solid fa-user"></i> Đăng nhập</a>
            @endif
        </div>
        
        <form id="logout" action="{{ route('user.logout') }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
<div id="contact">
    <div class="test">
        <div class="contact">
            <a href="https://www.facebook.com/messages/t/61558234972871" class="message">
                <img src="{{asset("assets/img/message.png")}}" style="width:100%" alt="zalo">
            </a>
        </div>
    </div>
</div>
<div id="menu-bar">
    <div class="menu">
        <li class="content-menu"><a href="{{route('user.home')}}"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
        <li class="content-menu"><a href="{{route('products.home')}}"><i class="fa-solid fa-box-open"></i> Sản phẩm</a></li>
        <li class="content-menu"><a href="#sale"><i class="fa-solid fa-ticket"></i> Khuyến mãi</a></li>
        <li class="content-menu"><a href="#footer"><i class="fa-solid fa-headset"></i> Liên hệ</a></li>
    </div>
    <div class="search">
        <form action="" id="form_search" method="POST">
            @csrf
            <input id="customer_code" type="text" name="id" placeholder="Tìm kiếm"> 
        </form>
        <a href="{{ request()->fullUrl() }}" onclick="" id="find" name="find" data-url="">Tìm kiếm</a>
        <a href="" onclick="" id="cancel" name="find">Huỷ</a>
    </div>
</div>