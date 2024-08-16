@extends('layouts.auth')

@section('content') 
<div id="main">
    <div class="form">
        <form action="{{ route('auth.register.post') }}" method="post">
            @csrf
            <div class="tittle-login">
                <h3>Register</h3>
            </div>
            <div class="input-information">
                <div class="input-user input">
                    <label for="username">Email</label> <br>
                    <input id="username" type="email" id="username" name="email" spellcheck="false" require="require"><br>
                    <label id="setUserError" name="setUserError" style="font-size: 14px; color:red;"></label>
                </div>
                <div class="input-user input">
                    <label for="username">Name</label> <br>
                    <input id="username" type="text" id="name" name="name" spellcheck="false" require="require"><br>
                    <label id="setUserError" name="setUserError" style="font-size: 14px; color:red;"></label>
                </div>
                <div class="input-pass input">
                    <label for="password">Password</label><br>
                    <input type="password" name="password" id="password" require="require"><br>
                    <label id="setPassError" name="setPassError" style="font-size: 14px; color:red;"></label>
                </div>
                <div class="input-pass input">
                    <label for="confirm-password">Confirm Password</label><br>
                    <input type="password" name="password_confirmation" id="confirm-password" require="require"><br>
                    <label id="setPassError" name="setPassError" style="font-size: 14px; color:red;"></label>
                </div>
            </div>
            <div class="btn-login">
                <button type="submit">Register</button>
            </div>
            <div class="login-api">
                <p style="text-align: center;">Sign in with</p>
                <ul>
                    <li><a href="#"><i style="color: rgb(39, 145, 244);" class="fa-brands fa-facebook fa-xl"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-github fa-xl"></i></a></li>
                    <li><a href="#"><i style="color: rgb(249, 50, 5);" class="fa-brands fa-google fa-xl"></i></a></li>
                </ul>
            </div>
            <div class="information-support">
                <span><a href="{{route('auth.forgetPassword.home')}}">Forget Password</a></span>
                <span><a href="{{route('auth.login')}}">Login</a></span>
            </div>
        </form>
    </div>
</div>
@endsection