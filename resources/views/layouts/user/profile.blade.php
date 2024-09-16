@extends('layouts.user')

@push('head')
    <link rel="stylesheet" href="{{asset("assets/user/css/profile.css")}}">
    <link rel="stylesheet" href="{{asset("assets/user/css/style.css")}}">
@endpush

@section('content')
    @include('layouts.user.header')
    <div id="container">
        <div class="avatar-menu">
            <div class="avatar">
                <img src="{{ asset("assets/img/bg-banking.png") }}" alt="">
            </div>
            <div class="menu">
                <ul>
                    <li>Thông tin người dùng</li>
                    <li>Đơn hàng của bạn</li>
                    <li>Voucher Giảm giá</li>
                    <li>Hạng thành viên</li>
                    <li>Đăng xuất</li>
                </ul>
            </div>
        </div>
        <div class="information">
            @yield('information')
        </div>
    </div>
    @include('layouts.user.footer')
@endsection