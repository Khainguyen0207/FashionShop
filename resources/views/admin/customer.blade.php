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
        <div class="search">
            <form action="" id="form_search" method="POST">
                @csrf
                <input id="customer_code" type="text" name="id" placeholder="Mã khách hàng"> 
                <input id="customer_name" type="text" name="name" placeholder="Tên khách hàng"> 
                <input id="email" type="email" name="email"placeholder="Email">
            </form>
            <a href="{{ request()->fullUrl() }}" onclick="" id="find" name="find" data-url=""><i class="fa-solid fa-magnifying-glass fa-xl"></i></a>
            <a href="{{$url}}" onclick="" id="cancel" name="find"><i class="fa-solid fa-xmark fa-xl"></i></a>
        </div>
    </div> 
    @include('layouts.table') 
    <div class="footer">
    </div>
</div>
@push('footer')
    <script src="{{ asset('assets/admin/js/find.js') }}"></script> 
    <script src="{{ asset('assets/js/table.js') }}"></script> 
@endpush
@endsection