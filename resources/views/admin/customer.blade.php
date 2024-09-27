@extends('layouts.admin')
@push('head')
    <link rel="stylesheet" href="{{asset('assets/admin/css/customer.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/addCategory.css')}}">
    <script src="{{asset('assets/admin/js/category.js')}}"></script>
@endpush

@section('overview')
<div id="addCategory">
    <div class="screen" onclick="clickAddCategory(event)"></div>
</div>
<div class="overview">
    <div id="header">
        <h1>Danh sách khách hàng</h1>
    </div>
    <div class="toolbar">
        <div class="menu">
            <p><i class="fa-solid fa-bars fa-xl"></i></p>
        </div>
        <div class="search">
            <input id="customer_code" type="text" name="customer_code" placeholder="Mã khách hàng"> 
            <input id="customer_name" type="text" name="customer_name" placeholder="Tên khách hàng"> 
            <input id="email" type="email" name="email"placeholder="Email"> 
            <a href="#" onclick="" id="find" name="find">Tìm kiếm</a>
        </div>
    </div> 
    @include('layouts.table')
    <div class="footer">
    </div>
</div>
@push('footer')
    <script src="{{ asset('assets/js/table.js') }}"></script> 
    <script src="{{ asset('assets/admin/js/customer.js') }}"></script> 
@endpush
@endsection