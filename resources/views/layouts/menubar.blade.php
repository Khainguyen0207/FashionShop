<ul class="list-menu">
    <div class="review">
        <p>Admin Fashion</p>
        <a href="#logo"><img src="{{asset('assets/admin/img/logo.png')}}" alt="logo"></a>
    </div>
    <div class="menu">
        <li>
            <a href="{{route('admin.home')}}"><i class="fa-solid fa-chart-line"></i> Tổng quan</a>
        </li>
        <li class="sub-menu">
            <a href="#"><i class="fa-solid fa-user"></i> Khách hàng <i class="icon-arrow fa-solid fa-caret-right"></i></a>
            <ul class="list-small">
                <li>
                    <p><a href="{{route('admin.customer.index')}}"><i class="fa-solid fa-list"></i> Danh sách khách hàng</a></p>
                </li>
                <li>
                    <p><a href=""><i class="fa-solid fa-headset"></i> CSKH</a></p>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{route('categories.home')}}"><i class="fa-solid fa-shirt"></i> Sản phẩm</a>
        </li>
        <li class="sub-menu">
            <a href="#"><svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512"><path d="m10,23c0,.553-.447,1-1,1h-4c-2.757,0-5-2.243-5-5V5C0,2.243,2.243,0,5,0h8c2.757,0,5,2.243,5,5v2c0,.553-.447,1-1,1s-1-.447-1-1v-2c0-1.654-1.346-3-3-3H5c-1.654,0-3,1.346-3,3v14c0,1.654,1.346,3,3,3h4c.553,0,1,.447,1,1ZM14,6c0-.553-.447-1-1-1H5c-.553,0-1,.447-1,1s.447,1,1,1h8c.553,0,1-.447,1-1Zm-4,5c0-.553-.447-1-1-1h-4c-.553,0-1,.447-1,1s.447,1,1,1h4c.553,0,1-.447,1-1Zm-5,4c-.553,0-1,.447-1,1s.447,1,1,1h2c.553,0,1-.447,1-1s-.447-1-1-1h-2Zm19,2c0,3.859-3.141,7-7,7s-7-3.141-7-7,3.141-7,7-7,7,3.141,7,7Zm-2,0c0-2.757-2.243-5-5-5s-5,2.243-5,5,2.243,5,5,5,5-2.243,5-5Zm-3.192-1.241l-2.223,2.134c-.144.141-.379.144-.522.002l-1.131-1.108c-.396-.388-1.028-.382-1.414.014-.387.395-.381,1.027.014,1.414l1.132,1.109c.46.449,1.062.674,1.663.674s1.201-.225,1.653-.671l2.213-2.124c.398-.383.411-1.016.029-1.414-.383-.4-1.017-.411-1.414-.029Z"/></svg>
                </i> Đơn hàng  <i class="icon-arrow fa-solid fa-caret-right"></i> 
                @if ( $quantity['sum'] != 0 )
                    <span class="quantity">{{ $quantity['sum'] }}</span>
                @endif
            </a>
            <ul class="list-small">
                <li>
                    <p><a href="{{ route("order.home") }}"><i class="fa-solid fa-list"></i> Chờ duyệt 
                        @if ($quantity['quantity_order_confirmation'] != 0)
                            <span class="quantity">{{ $quantity['quantity_order_confirmation'] }}</span>
                        @endif
                    </a></p>
                </li>
                <li>
                    <p><a href="{{ route("order.order_in_transit") }}"><i class="fa-solid fa-list"></i> Đang giao 
                        @if ($quantity['number_of_order_in_transit'] != 0)
                            <span class="quantity">{{ $quantity['number_of_order_in_transit'] }}</span>
                        @endif
                    </a></p>
                </li>
                <li>
                    <p><a href="{{ route("order.orders") }}"><i class="fa-solid fa-list"></i> Kiểm tra đơn hàng</a></p>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa-solid fa-gear"></i> Cài đặt <i class="icon-arrow fa-solid fa-caret-right"></i></a>
            <ul class="list-small">
                <li>
                    <p><a href="{{route("admin.setting.home", ['page' => "admin"])}}"><i class="fa-solid fa-headset"></i> Quản trị viên</a></p>
                </li>
                <li>
                    <p><a href="{{route("admin.setting.home", ['page' => "user"])}}"><i class="fa-solid fa-home"></i> Trang chính</a></p>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{route('admin.event.home')}}"><i class="fa-regular fa-calendar"></i> Sự kiện </a>
        </li>
        <li>
            <a href="{{route('user.home')}}"><i class="fa-solid fa-circle-arrow-left"></i> Về giao diện shop</a>
        </li>
        <li>
            <a href="{{route('admin.logout')}}" name="action" value="logout"><i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal"></i> Đăng xuất</a>
        </li>
    </div>
    <div class="footer-slider">
        <p><a target="_blank" href="https://www.facebook.com/ntkhai2005"><span style="color: #A66E38">Designer:</span> KhaiNguyen0207</a></p>
    </div>
</ul>