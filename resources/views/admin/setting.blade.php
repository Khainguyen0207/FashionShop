@extends('layouts.admin')
@push('head')
    <link rel="stylesheet" href="{{asset('assets/admin/css/setup.css')}}">
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
                <script>
                    window.location.href = '/admin';
                </script>
        @endswitch
    </div>
@endsection
@push('footer')
    <script src="{{asset('assets/admin/js/setting.js')}}"></script>
@endpush