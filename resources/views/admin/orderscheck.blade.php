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
        <div class="search">
            <form action="" method="get" id="form_search">
                <input type="text" name="order_code" placeholder="Mã đơn hàng">
            </form>
            <a href="{{ request()->fullUrl() }}" onclick="" id="find" name="find" data-url=""><i class="fa-solid fa-magnifying-glass fa-xl"></i></a>
            <a href="{{$url}}" onclick="" id="cancel" name="find"><i class="fa-solid fa-xmark fa-xl"></i></a>
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