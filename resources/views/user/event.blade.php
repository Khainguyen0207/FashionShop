@extends("layouts.user")
@push('head')
    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/event.css')}}">
    <title>Sự kiện</title>
@endpush
@section('content')
    @include('layouts.user.header')
    <div id="container">
        <div class="main_content">
            {!! $information !!}
        </div>
    </div>
    @include('layouts.user.footer')
@endsection