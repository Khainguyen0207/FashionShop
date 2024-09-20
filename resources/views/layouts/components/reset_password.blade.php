@extends('layouts.user.profile')
@push('head')
    <link rel="stylesheet" href="{{asset('assets/user/css/information.css')}}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endpush
@section('information')
    <div id="auth">
        <div id="reset_password">
            <a href="" class="btn btn-back" style="margin:10px 0;">Quay lại</a>
            <form action="{{ route("profile.post") }}" method="post">
                @csrf
                <h2 style="margin-bottom: 10px; border-bottom: 1px solid lightgray">Thay đổi mật khẩu</h2>
                <label for="new_password">Mật khẩu mới</label>
                <input type="password" name="password" id="password">
                <button type="submit" class="btn btn-save" style="margin-top: 10px;">Thay đổi</button>
            </form>
        </div>
    </div>
@endsection