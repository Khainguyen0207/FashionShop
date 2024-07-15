@extends('layouts.admin')
@push('head')
    <link rel="stylesheet" href="{{asset('assets/admin/css/customer.css')}}">
@endpush

@section('overview')
<div class="overview">
    <div class="toolbar">
        <div class="menu">
            <p><i class="fa-solid fa-bars fa-xl"></i></p>
        </div>
        <div class="search">
            <input id="search" type="search" placeholder="Tìm kiếm"> 
            <a href="#" onclick="alert(document.getElementById('search').value)">Tìm kiếm</a>
        </div>
    </div> 
    @include('layouts.table')

    {{-- Chân trang  --}}
</div>
@endsection