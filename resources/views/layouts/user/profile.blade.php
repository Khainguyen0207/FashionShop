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
                        <img src="{{ asset("assets/user/img/box.png") }}" alt="">
                        <div class="animation-img">
                            <p style="color: black">Edit</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menu">
                <ul style="">
                    <a href="#"><li>Thông tin</li></a>
                    <a href="#"><li>Đơn hàng của bạn</li></a>
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
