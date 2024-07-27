@extends('layouts.master')

@push('head')
    <link rel="shortcut icon" href="{{ asset('assets/admin/img/logo-2.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/products.css') }}">
@endpush

@section('content')
    <div id="container">
        @include('layouts.categories.menubar')
        @yield('overview')
    </div>
@endsection