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
            <a href="{{route('admin.customer.index')}}"><i class="fa-solid fa-user"></i> Khách hàng <i class="icon-arrow fa-solid fa-caret-right"></i></a>
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
            </i> Đơn hàng <i class="icon-arrow fa-solid fa-caret-right"></i></a>
            <ul class="list-small">
                <li>
                    <p><a href="#"><i class="fa-solid fa-list"></i> Đơn hàng hôm nay</a></p>
                </li>
                <li>
                    <p><a href="#"><i class="fa-solid fa-list"></i> Kiểm tra đơn hàng</a></p>
                </li>
            </ul>
        </li>
        <li>
            <a href="/admin/history"><svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" id="Bold" viewBox="0 0 24 24" width="512" height="512"><path d="M12,0A12.034,12.034,0,0,0,4.04,3.04L2.707,1.707A1,1,0,0,0,1,2.414V7A1,1,0,0,0,2,8H6.586a1,1,0,0,0,.707-1.707L6.158,5.158A9,9,0,0,1,21,12.26,9,9,0,0,1,3.1,13.316,1.51,1.51,0,0,0,1.613,12h0A1.489,1.489,0,0,0,.115,13.663,12.018,12.018,0,0,0,12.474,23.991,12.114,12.114,0,0,0,23.991,12.474,12.013,12.013,0,0,0,12,0Z"/><path d="M11.5,7h0A1.5,1.5,0,0,0,10,8.5v4.293a2,2,0,0,0,.586,1.414L12.379,16A1.5,1.5,0,0,0,14.5,13.879l-1.5-1.5V8.5A1.5,1.5,0,0,0,11.5,7Z"/></svg> Lịch sử</a>
        </li>
        <li>
            <a href="{{route('user.home')}}"><i class="fa-solid fa-circle-arrow-left"></i> Về giao diện shop</a>
        </li>
        <li>
            <a href="{{route('admin.logout')}}" name="action" value="logout"><i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal"></i> Đăng xuất</a>
        </li>
    </div>
    <div class="footer-slider">
        <p><a target="_blank" href="https://www.facebook.com/ntkhai2005">KhaiNguyen0207</a></p>
    </div>
</ul>