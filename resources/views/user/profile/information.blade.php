@extends('layouts.user.profile')
@push('head')
    <link rel="stylesheet" href="{{asset('assets/user/css/information.css')}}">
@endpush
@section('information')
    <div class="title-information">
        <h2 class="title">Thông tin người dùng</h2>
        <div class="form-information">
            <form action="" method="post">
                @csrf
                <div class="group name">
                    <label for="name">Họ và tên</label>
                    <input type="text" name="name" id="name" value="{{ $name }}" spellcheck="false" required>
                </div>
                <div class="group address">
                    <label for="birthday">Ngày sinh</label>
                    <input type="date" name="birthday" id="birthday" value="{{ $birthday }}"  spellcheck="false" required>
                </div>
                <div class="group sex">
                    <label for="sex">Giới tính</label>
                    <select name="sex" id="sex" required>
                        <option value=""></option>
                        <option value="0">Nam</option>
                        <option value="1">Nữ</option>
                        <script>
                            document.getElementById("sex").value = {{$sex}};
                        </script>
                    </select>
                </div>
                <div class="group address">
                    <label for="address">Địa chỉ</label>
                    <input type="text" name="address" id="address" value="{{ $address }}"  spellcheck="false" required>
                </div>
                <button type="submit" onclick="check()" class="btn btn-save">Lưu thay đổi</button>
            </form>
        </div>
    </div>
    <div class="title-information">
        <h2 class="title">Thông tin liên hệ</h2>
        <div class="form-information">
            <form action="" method="post">
                @csrf
                <div class="group">
                    <label for="number_phone">SĐT</label>
                    <input type="text" name="number_phone" id="number_phone" value="{{ $number_phone }}"  spellcheck="false"> 
                </div>
                <div class="group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ $email }}">
                </div>
                <button type="submit" class="btn btn-save">Lưu thay đổi</button>
            </form>
        </div>
    </div>
    <div class="title-information late">
        <h2 class="title">Bảo mật</h2>
        <div class="form-information">
            <a href="">Đổi mật khẩu</a>
            <a href="">Quên mật khẩu</a>
        </div>
    </div>
    
@endsection