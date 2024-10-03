@extends('layouts.admin')
@push('head')
    <link rel="stylesheet" href="{{asset('assets/admin/css/customer.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/addCategory.css')}}">
    <script src="{{asset('assets/admin/js/category.js')}}"></script>
@endpush

@section('overview')
<div id="addCategory">
</div>
<div class="overview">
    <div id="header">
        <h1>Đơn hàng</h1>
    </div>
    <div class="toolbar">
        <div class="menu">
            <p><i class="fa-solid fa-bars fa-xl"></i></p>
        </div>
        <div class="search">
            <form action="" method="get" id="form_search">
                <input type="text" name="order_code" placeholder="Mã đơn hàng">
            </form>
            <a href="{{ request()->fullUrl() }}" data-url="" id="find">Tìm kiếm</a>
            <a href="{{ $url }}" data-url="" id="cancel">Hủy</a>
        </div>
    </div> 
    @include('layouts.table')
    <div class="footer">
    </div>
</div>
<footer>
    <script src="{{asset("assets/admin/js/order.js")}}"></script>
    <script src="{{asset("assets/admin/js/find.js")}}"></script>
</footer>
@endsection