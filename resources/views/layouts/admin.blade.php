@extends('layouts.master')
@push('head')
    @php
        $header = getHeader();
    @endphp
    @if (isset($header['logo']))
        <link rel="shortcut icon" href="{{ $header['logo'] }}" type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ asset('assets/user/img/box.png') }}" type="image/x-icon">
    @endif
    <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Inconsolata:wdth,wght@83.5,200..900&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/responsize-admin.css') }}">
@endpush

@section('content')
    <section>
        <div id="container">
            <div class="menu-bar-icon" tabindex="0">
                <i class="fa-solid fa-bars fa-xl"></i>
            </div>
            <div class="menu-bar">
                @include('layouts.menubar')
            </div>
            @yield('overview')
        </div>
    </section>
@endsection