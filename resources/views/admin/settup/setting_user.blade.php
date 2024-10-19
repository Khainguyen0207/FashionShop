<h1 class="tittle">Cài đặt giao diện trang chính</h1>
<div class="setup-user">
    <div class="logo">
        <h3>Logo</h3>
        <div class="image">
            <a href="{{route("admin.setting.edit") }}" class="action_img"><img id="logo" src="{{ $logo }}" alt="logo_shop" srcset="">
            <div class="animation">
                <p style="color: white; text-align: center">Chỉnh sửa</p>
            </div>
        </a>
        </div>
    </div>
    <div class="image_shop_banner">
        <h3>Ảnh giới thiệu về cửa hàng</h3>
        <div class="image">
            <a href="{{route("admin.setting.edit") }}" class="action_img"><img id="banner" src="{{ $banner }}" alt="banner-shop" srcset="">
            <div class="animation" onclick="">
                <p style="color: white; text-align: center">Chỉnh sửa</p>
            </div>
        </a>
        </div>
    </div>
    <div class="information_shop">
        <div class="social_network information">
            <h3>Mạng xã hội</h3>
            <ul class="list">
                <li>Facebook</li>
                <li><input type="text" value="{{ $social_network['facebook'] }}"></li>
                <li>Instagram</li>
                <li><input type="text" value="{{$social_network['instagram']}}"></li>
                <li>Tiktok</li>
                <li><input type="text" value="{{$social_network['tiktok']}}"></li>
            </ul>
        </div>
        <div class="contact information">
            <h3>Liên hệ</h3>
            <ul class="list">
                <li>Số điện thoại</li>
                <li> <input type="text" value="{{$contact['hotline']}}"> </li>
                <li>Email</li>
                <li><input type="text" value="{{$contact['email']}}"></li>
                <li>Địa chỉ</li>
                <li><input type="text" value="{{$contact['address']}}"></li>
            </ul>
        </div>
    </div>
    <div class="btn_action action">
        <a href="" class="btn">Lưu thay đổi</a>
        <a href="" class="btn btn-del">Hủy thay đổi</a>
    </div>
</div>
