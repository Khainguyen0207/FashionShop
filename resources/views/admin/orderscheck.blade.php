@extends('layouts.admin')
@push('head')
    <link rel="stylesheet" href="{{asset('assets/admin/css/customer.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/addCategory.css')}}">
    <script src="{{asset('assets/admin/js/category.js')}}"></script>
@endpush

@section('overview')
<div class="overview">
    <div id="header">
        <h1>Danh sách khách hàng</h1>
    </div>
    <div class="toolbar">
        <div class="menu">
            <p><i class="fa-solid fa-bars fa-xl"></i></p>
        </div>
        <div class="search">
            <input id="text" type="text" placeholder="Mã đơn hàng">
            <a href="#" onclick="alert(document.getElementById('text').value)">Tìm kiếm</a>
        </div>
    </div> 
    @include('layouts.table')
    <div class="footer">
    </div>
</div>
@endsection