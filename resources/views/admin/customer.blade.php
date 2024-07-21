@extends('layouts.admin')
@push('head')
    <link rel="stylesheet" href="{{asset('assets/admin/css/customer.css')}}">
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
            <input id="text" type="text" placeholder="Mã khách hàng"> 
            <input id="text" type="text" placeholder="Tên khách hàng"> 
            <input id="text" type="email" placeholder="Email"> 
            <a href="#" onclick="alert(document.getElementById('text').value)">Tìm kiếm</a>
        </div>
    </div> 
    @include('layouts.table')
    <div class="footer">
        
    </div>
</div>
@endsection