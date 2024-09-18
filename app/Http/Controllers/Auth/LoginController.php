<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showFormLogin()
    {
        return view('auth.login', ['title' => 'Đăng nhập']);
    }

    public function index()
    {
        if (Auth::check()) {
            return redirect(route('user.home'));
        }

        return redirect(route('login'));
    }

    public function create() {}

    public function store(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (! Auth::attempt($credentials, $remember)) {
            throw ValidationException::withMessages(['email' => 'Tài khoản hoặc mật khẩu không chính xác']);
        }

        return redirect(route('user.home'));
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
