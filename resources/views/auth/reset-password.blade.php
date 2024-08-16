@extends('layouts.auth')
@section('content')
<div id="main">
    <div class="form">
        <form action="{{ route('password.reset.confirm') }}" method="post">
            @csrf
            <div class="tittle-login">
                <h3>Code</h3>
            </div>
            <div class="input-information">
                <div class="input-user input">
                    <label for="" style="font-size:20px;">Email</label><br>
                    <input id="email" type="email" name="email" spellcheck="false" value="{{ $email }}" readonly><br>
                </div>
                <div class="input-user input">
                    <label for="" style="font-size:20px;">Code</label> <br>
                    <input id="code" type="text" name="code" spellcheck="false"><br>
                </div>
            </div>
            <div class="btn-login">
                <button type="submit" id="btn-sendmail">Confirm</button>
            </div>
        </form>
        <div class="information-support">
            <a href="{{route('auth.forgetPassword.home')}}">Thay đổi mail</a>
            </div>
    </div>
</div>
@endsection

@push('footer')
    <script src="{{asset('assets/auth/forget-password.js')}}"></script>
@endpush