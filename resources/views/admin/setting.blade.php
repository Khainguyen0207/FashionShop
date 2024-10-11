@extends('layouts.admin')
@push('head')
    <link rel="stylesheet" href="{{asset('assets/admin/css/customer.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/addCategory.css')}}">
    <script src="{{asset('assets/admin/js/category.js')}}"></script>
@endpush

@section('overview')
    <div class="overview">
        <h1 class="title">Cài đặt giao diện trang</h1>
        <div class="setup-admin">
            
        </div>
        <div class="setup-user">
            
        </div>
    </div>
@endsection
@push('footer')
@endpush