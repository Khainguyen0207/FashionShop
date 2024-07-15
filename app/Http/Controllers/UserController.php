<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home() {
        $account = Auth::user();
        $render = [
            'title' => 'Trang chủ',
            'name' => $account->name,
            'role' => $account->role,
        ];
        return view('user.home', $render);
    }

    public function store(Request $request) {
        return "Hello";
    }

    public function destroy()  {
        Auth::logout();
        return redirect('auth');
    }
}
