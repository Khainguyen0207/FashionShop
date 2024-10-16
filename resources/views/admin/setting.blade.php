@extends('layouts.admin')
@push('head')
    <link rel="stylesheet" href="{{asset('assets/admin/css/customer.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/addCategory.css')}}">
    <script src="{{asset('assets/admin/js/category.js')}}"></script>
@endpush

@section('overview')
    <div class="overview">
        <h1 class="title">Cài đặt giao diện trang quản trị viên</h1>
        <div class="setup-admin">
            <h3>Cài đặt sản phẩm</h3>
            <div class="product-options">
                <div class="size-option">
                    <p>Setup 1</p>
                    <table>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </table>
                </div>  
                <div class="color-option">
                    
                </div>
            </div>
        </div>
        <h1 class="tittle">Cài đặt giao diện trang chính</h1>
        <div class="setup-user">
            <h3>Logo</h3>
            <h3>Ảnh giới thiệu về cửa hàng</h3>
            <div class="information_shop">
                <h3>Mạng xã hội</h3>
                <h3>Liên hệ</h3>
            </div>
        </div>
    </div>
@endsection
@push('footer')
@endpush