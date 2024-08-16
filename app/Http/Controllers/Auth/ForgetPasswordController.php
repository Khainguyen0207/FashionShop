<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\User_otp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\DeleteQuerySendCode;
use App\Mail\UserActivationEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgetPasswordRequest;

class ForgetPasswordController extends Controller
{
    public function index() {
        return view('auth.forget-password', ['title' => 'Quên mật khẩu', 'url' => route('auth.forgetPassword.home')]);
    }

    public function store(ForgetPasswordRequest $forgetPasswordRequest ) {
        $data = $forgetPasswordRequest->validated();
        $code = floor(rand(100000, 999999));
        $token = hash('sha256', Str::uuid());
        $request =
            [
                'email' => $data['email'],
                'token' => $token,
                'code' => $code,
                'expired_at' => now()->addMinutes(10)
            ];
        if (!User::query()->where('email', $data['email'])->exists()) {
            return back()->withErrors(['errors' => __('Địa chỉ email không tồn tại')]);
        }
        $send = User_otp::query()->where('email', $data['email'])->exists();
        if ($send) {
            $expired_time = User_otp::query()->where('email', $data['email'])->first();
            if (Carbon::now()->diffInMinutes($expired_time->expired_at) < 8) {
                User_otp::query()->where('email', $data['email'])->update($request);
                Mail::to($data['email'])->queue(new UserActivationEmail("Mã khôi phục - Fashion Store", $code));
                return redirect(route('password.reset', ['token' => $token, 'email' => $data['email']]))->with(['success' => __('Chúng tôi đã gửi mã xác thực đến email của bạn')]);
            } else {
                return back()->withErrors(['errors'=> 'Thử lại sau vài phút']);
            }
        }
        User_otp::query()->create($request);
        Mail::to($data['email'])->queue(new UserActivationEmail("Mã khôi phục - Fashion Store", $code));
        return redirect(route('password.reset', ['token' => $token, 'email' => $data['email']]))->with(['success' => __('Chúng tôi đã gửi mã xác thực đến email của bạn')]);
    }

    public function edit(Request $request) {
        if (!User_otp::query()->where('token', $request->token)->exists()) {
            abort(404);
        }
        return view('auth.reset-password', ['title' => "Xác nhận", 'email' => $request->email]);
    }

    public function confirm(Request $request) {
        $code = $request->validate(
            [
                'code' => 'required|int',
            ]
        );
        $data = User_otp::query()->where('email', $request->email)->first();
        if (($data->code == $code['code']) && (Carbon::now()->diffInMinutes($data->expired_at) > 0) ) {
            $token = hash('sha256', Str::uuid());
            $update = [
                'token' => $token,
            ];
            User_otp::query()->update($update);
            return redirect(route('password.change', ['token' => $token, 'email' => $request->email]));
        }
        return back()->withErrors(['errors' => 'Mã xác nhận không đúng hoặc hết hạn']);
    }

    public function edit_password(Request $request) {
        if (!User_otp::query()->where('token', $request->token)->exists()) {
            abort(404);
        }
        $token = $request->token;
        $email = $request->email;
        $title = 'Đổi mật khẩu';
        // Trả về view với compact
        return view('auth.change-password', compact('token', 'email', 'title'));
        // return view('auth.change-password', ['title' => "Xác nhận", 'token' => $request->token, ]);
    }

    public function change(ChangePasswordRequest $request) {
        $code = $request->validated();
        $user = User::query()->where('email', $request->email)->first();
        $user->password = $code['password'];
        $user->save();
        // User::query()->where('email', $request->email)->update(['password'=> $code['password']]);
        return redirect(route('login'))->with(['success' => 'Đổi mật khẩu thành công']);
    }
}