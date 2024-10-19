<div id="header">
    @php
        $header = getHeader();
    @endphp

    @if (isset($header['logo']))
        <a href="/"><img src="{{ $header['logo'] }}" alt="logo"></a>
    @else
        <a href="/"><img src="{{ asset('assets/user/img/box.png') }}" alt="logo"></a>
    @endif
    
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
            <a href="https://www.facebook.com/ntkhai2005" class="message">
                <img src="{{asset("assets/img/message.png")}}" style="" alt="zalo">
            </a>
        </div>
    </div>
</div>
<div id="menu-bar">
    <div class="menu_icon" tabindex="0"><i class="fa-solid fa-bars fa-2xl"></i></div>
    <div class="menu">
        <li class="content-menu"><a href="{{route('user.home')}}"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
        <li class="content-menu"><a href="{{route('products.home')}}"><i class="fa-solid fa-box-open"></i> Sản phẩm</a></li>
        <li class="content-menu"><a href="#sale"><i class="fa-solid fa-ticket"></i> Khuyến mãi</a></li>
        <li class="content-menu"><a href="#footer"><i class="fa-solid fa-headset"></i> Liên hệ</a></li>
    </div>
    <div class="search">
        <form action="" id="form_search" method="POST">
            @csrf
            <input id="customer_code" type="text" name="search" placeholder="Tìm kiếm"  value="{{request()->query("search")}}"> 
        </form>
        <a href="{{ route("user.home.post") }}" onclick="" id="find"><i class="fa-solid fa-magnifying-glass"></i></a>
        <a href="{{  url()->current() }}" onclick="" id="cancel" name="cancel"><i class="fa-solid fa-xmark"></i></a>
    </div>
</div>