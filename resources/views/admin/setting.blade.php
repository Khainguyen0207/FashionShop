@extends('layouts.admin')
@push('head')
    <link rel="stylesheet" href="{{asset('assets/admin/css/setup.css')}}">
    <style>
        .info {
            position: relative;
            display: inline-block;
            cursor: pointer;

        }

        .tooltip {
            visibility: hidden;
            position: absolute;
            background-color: #555;
            color: #fff;
            border-radius: 5px;
            padding: 5px;
            width: 150px;
            bottom: 100%; /* Vị trí phía trên */
            left: 50%;
            margin-left: -75px; /* Căn giữa */
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 10px
        }

        .info:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }
    </style>
@endpush
@section('overview')
    <div class="overview">
        @switch(request()->query("page"))
            @case("user")
                @include('admin.settup.setting_user')
                @break;
            @case("admin")
                @include('admin.settup.setting_admin')
                @break;
            @default
                @include('admin.settup.setting_admin')
                @break;
        @endswitch
    </div>
@endsection
@push('footer')
    <script src="{{asset('assets/admin/js/setting.js')}}"></script>
@endpush