<div id="header">
    <a href="#"><img src="{{asset('assets/user/img/logo.png')}}" alt="logo"></a>
    <div class="bar">
        <a href="{{route('user.cart.home')}}" class="cart"><i class="fa-solid fa-cart-shopping" ></i> Giỏ hàng</a>
        <a href="#" class="login" onclick="event.preventDefault(); document.getElementById('logout').submit();"><i class="fa-solid fa-user"></i> Đăng xuất</a>
        <form id="logout" action="{{ route('user.logout') }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
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
        <i class="icon fa-solid fa-magnifying-glass"></i>
        <input type="search" name="search" placeholder="Tìm kiếm"> 
    </div>
</div>