@extends('layouts.master')
@push('head')
    <link rel="shortcut icon" href="{{asset('assets/admin/img/logo-2.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
    <script src="https://kit.fontawesome.com/1c7dcab6ce.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Inconsolata:wdth,wght@83.5,200..900&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Dashboard</title>
@endpush

@section('content')
    <section>
        <div id="container">
            <div class="menu-bar">
                @include('layouts.menubar')
            </div>
            @yield('overview')
        </div>
    </section>
@endsection



