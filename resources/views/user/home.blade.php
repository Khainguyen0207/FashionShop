@extends('layouts.master')
@push('head')
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.ico')}}" type="image/x-icon">
@endpush
@section('content')
    <div>
        <label for="">Người dùng: {{ $name }}</label>
        @if ($role == 1)
            <p>Phân quyền: Admin</p>
            <a href="{{route('admin.home')}}">Chuyển trang admin</a>
        @else
            <p>Phân quyền: Người dùng</p>
        @endif
    </div>
    <form action="{{ route('user.logout') }}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit">Đăng xuất</button>
    </form>
@endsection 