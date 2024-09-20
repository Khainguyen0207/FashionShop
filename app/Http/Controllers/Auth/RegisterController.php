<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Error;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class RegisterController extends Controller
{
    public function home()
    {
        $fill = [
            'title' => 'Đăng ký',
        ];

        return view('auth/register', $fill);
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->validated();
        $data += ['role' => 0];
        User::query()->create($data);
        return redirect()->route('login')->with(['success' => 'Đăng ký thành công']);
    }
}
