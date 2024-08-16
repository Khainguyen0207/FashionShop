@extends('layouts.auth')
@section('content')
<div id="main">
    <div class="form">
        <form action="{{ route('auth.forgetPassword.store') }}" method="post">
            @csrf
            <div class="tittle-login">
                <h3>Forget Password</h3>
            </div>
            <div class="input-information">
                <div class="input-user input">
                    <label for="" style="font-size:20px;">Recovery email</label> <br>
                    <input id="recovery_email" type="email" name="email" spellcheck="false" value="admin@admin.vn"><br>
                </div>
            </div>
            <div class="btn-login">
                <button type="submit" id="btn-sendmail">Send mail</button>
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
                <span><a href="{{ route('login') }}">Login</a></span>
                <span><a href="{{ route('auth.register') }}">Register</a></span>
            </div>
        </form>
    </div>
</div>
@endsection

@push('footer')
    <script src="{{asset('assets/auth/forget-password.js')}}"></script>
@endpush