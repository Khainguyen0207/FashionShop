@extends('layouts.auth')
@section('content')
<div id="main">
    <div class="form">
        <form action="{{ route('password.change.confirm') }}" method="post">
            @csrf
            <div class="tittle-login">
                <h3>Code</h3>
            </div>
            <div class="input-information">
                <div class="input-pass input">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <label for="password">New Password</label><br>
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
                <button type="submit">Change</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('footer')
    <script src="{{asset('assets/auth/forget-password.js')}}"></script>
@endpush