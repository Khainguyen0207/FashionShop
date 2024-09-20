<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\User_otp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\UserActivationEmail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Stmt\Return_;

use function PHPUnit\Framework\returnSelf;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::query()->where('id', Auth::id())->first();
        $information = $user->attributesToArray();
        $render = [
            'avatar' => $user->avatar_url,
            'name' => $information['name'],
            'birthday' => Carbon::parse($user->birthday)->format('Y-m-d'),
            'sex' => $information['sex'],
            'address' => $information['address'],
            'number_phone' => $information['number_phone'],
            'email' => $information['email'],
        ];

        return view('user.profile.information', $render);
    }

    public function store(Request $request)
    {
        $data = [];
        foreach ($request->request as $key => $value) {
            if ($key == '_token') {
                continue;
            }
            $data += [$key => $value];
        }
        $avatar = $request->file('avatar');
        if (isset($avatar)) {
            $url_old = User::query()->where('id', Auth::id())->first()->avatar;
            Storage::delete($url_old);
            $url = $avatar->store('avatar', 'public');
            $data += ['avatar' => $url];
        }
        try {
            User::query()->where('id', Auth::id())->update($data);
        } catch (\Throwable $th) {
            Log::error('Database error occurred', [
                'message' => $th->getMessage(),
            ]);
            return redirect(route('profile.home'))->with('error', 'Cập nhật thông tin thất bại');
        }
        return redirect(route('profile.home'))->with('success', 'Cập nhật thông tin thành công');
    }

    public function show(Request $request)
    {
        $query = $request->query()['auth'];

        if ($query == 'change_password') {
            return view('layouts.components.change_password');
        } elseif ($query == 'forget_password') {
            $email = User::query()->where('id', Auth::id())->first();
            $data = [
                'email' => $email->email
            ];
            return view('layouts.components.forget_password', $data);
        }
    }

    public function edit(Request $request) {
        $code = floor(rand(100000, 999999));
        $token = hash('sha256', Str::uuid());
        $otp = User_otp::query();
        $sendmail = $otp->where('email', $request->email)->first();
        if (!isset($sendmail)) {
            $otp->create(['email' => $request->email, 'code' => $code, 'token' => $token, 'expired_at' => Carbon::now()]);
            Mail::to($request->email)->queue(new UserActivationEmail('Mã khôi phục - Fashion Store', $code));
            return redirect()->back()->with(['success' => __('Chúng tôi đã gửi mã xác thực đến email của bạn')]);
        }
        $expired_time = $otp->where('email', $request->email)->first();
        if ($expired_time->expired_at->diffInMinutes(Carbon::now()) <= 10) {
            return back()->withErrors(['errors' => 'Thử lại sau vài phút']);
        } else {
            $otp->where('email', $request->email)->update(['expired_at' => Carbon::now(), 'token' => $token]);
            Mail::to($request->email)->queue(new UserActivationEmail('Mã khôi phục - Fashion Store', $code));
            return redirect()->back()->with(['success' => __('Chúng tôi đã gửi mã xác thực đến email của bạn')]);   
        }
    }

    public function reset_password($token) {
        $token_real = User_otp::query()->where('email', request()->email)->first('token');
        if ($token_real->token == $token) {
            $user = User::query()->where('id', Auth::id())->first('avatar');
            return view('layouts.components.reset_password', ['avatar' => Storage::url($user->avatar)]);
        } 
        return abort(404);
    }

    public function change_password(ChangePasswordRequest $request) {
        $user = User::query()->where('id', Auth::id());
        $information = $user->first();
        if ($information->password !== $request->old_password) {
            return redirect()->back()->with("error", "Mật khẩu cũ không chính xác!");
        }
        try {
            $user->update(['password'=> $request->password]);
        } catch (\Throwable $th) {
            Log::error('Database error occurred', [
                'message' => $th->getMessage(),
            ]);
            return redirect()->back()->with("error", "Đổi mật khẩu thất bại!");
        };
        return redirect()->back()->with("success", "Mật khẩu đã được thay đổi!");
    }

    public function confirm(Request $request) {
        $code = "";
        foreach ($request->code as $value) {
            $code .= $value;
        }
        $token = hash('sha256', Str::uuid());
        $data = User_otp::query()->where("email", $request->email)->first();
        if ($data->code == $code) {
            User_otp::query()->where('email', $request->email)->update(['token' => $token]);
            return redirect(route('profile.reset_password', [$token, 'email' => $request->email]));
        }
        return redirect()->back()->with(['error' => __('Sai mã')]);
    }
}
