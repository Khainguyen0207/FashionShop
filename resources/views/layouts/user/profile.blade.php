@extends('layouts.user')

@push('head')
    <link rel="stylesheet" href="{{asset("assets/user/css/profile.css")}}">
    <link rel="stylesheet" href="{{asset("assets/user/css/style.css")}}">
@endpush

@section('content')
    @include('layouts.user.header')
    <div id="container">
        <div class="avatar-menu">
            <div class="avt">
                <div class="avatar">
                    <div class="img-avt">
                        <a href="#hello"><img src="{{ asset("assets/user/img/box.png") }}" id="avt-profile" alt=""></a>
                        <div class="animation-img">
                            <p style="color: black">Chỉnh sửa</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menu">
                <ul style="">
                    <a href="{{route('profile.home')}}"><li>Thông tin</li></a>
                    <a href="{{route("profile.order.home")}}"><li>Đơn hàng của bạn</li></a>
                    <a href="#"><li>Voucher Giảm giá</li></a>
                    <a href="#"><li>Hạng thành viên</li></a>
                    <a href="#" onclick="document.getElementById('logout').submit()"><li>Đăng xuất</li></a>
                </ul>
            </div>
        </div>
        <form id="logout" action="{{ route('user.logout') }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
        <div class="information">
            @yield('information')
        </div>
    </div>
    @include('layouts.user.footer')
@endsection
