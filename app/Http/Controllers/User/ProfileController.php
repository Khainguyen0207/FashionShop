<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
            Log::error('Profile_Error', $th);

            return redirect()->back()->with('error', 'Cập nhật thông tin thất bại');
        }

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }

    public function show(Request $request)
    {
        $query = $request->query()['auth'];

        if ($query == 'change_password') {
            return view('layouts.components.change_password');
        } elseif ($query == 'forget_password') {
            return view('layouts.components.forget_password');
        }
    }
}
