@extends('layouts.auth')

@section('content')
<div id="main">
    <div class="alert-danger" style="display: none;">Đăng nhập thất bại!</div>
    <div class="form">
        <form action="{{ route('auth.login') }}" method="post">
            @csrf
            <div class="tittle-login">
                <h3>LOGIN</h3>
            </div>
            <div class="input-information">
                <div class="input-user input">
                    <label for="">Email</label> <br>
                    <input id="email" type="email" name="email" spellcheck="false" require="require" value="admin@admin.vn"><br>
                </div>
                <div class="input-pass input">
                    <label for="">Password</label><br>
                    <input type="password"  id="password" name="password"  require="require" value="123456"><br>
                </div>
            </div>
            <div class="btn-login">
                <button type="submit" id="btn-validate" >Login</button>
            </div>
            <div class="save-user" style="margin-bottom: 10px">
                <input class="remember-login" type="checkbox" name="remember" id="remember"/> 
                <span>Remember me</span>
            </div>
            <div class="login-api">
                <p style="text-align: center;">Sign in with</p>
                <ul>
                    <li><a href="#"><i style="color: rgb(39, 145, 244);" class="fa-brands fa-facebook fa-xl"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-github fa-xl"></i></a></li>
                    <li><a href=""><i style="color: rgb(249, 50, 5);" class="fa-brands fa-google fa-xl"></i></a></li>
                </ul>
            </div>
            <div class="information-support">
                <span><a href="{{ route('auth.forgetPassword') }}">Forget Password</a></span>
                <span><a href="{{ route('auth.register') }}">Register</a></span>
            </div>
        </form>
    </div>
</div>
@endsection