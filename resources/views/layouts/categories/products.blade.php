@extends('layouts.master')

@push('head')
    <link rel="shortcut icon" href="{{ asset('assets/admin/img/logo-2.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/products.css') }}">
    <title>Dashboard</title>
@endpush

@section('content')
    <div id="container">
        <div class="menu-bar-icon" tabindex="0">
            <i class="fa-solid fa-bars fa-xl"></i>
        </div>
        @include('layouts.categories.menubar')
        @yield('overview')
    </div>
@endsection
@push('footer')
@endpush