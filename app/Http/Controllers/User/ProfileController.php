<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index() {
        $user = User::query()->where('id', Auth::id())->first();
        $information = $user->attributesToArray();
       
        $render = [
            'name' => $information['name'],
            'birthday' => Carbon::parse($user->birthday)->format('Y-m-d'),
            'sex' => $information['sex'],
            'address' => $information['address'],
            'number_phone' => $information['number_phone'],
            'email' => $information['email'],
        ];
        return view('user.profile.information', $render);
    }

    public function store(Request $request) {
        $data = [];
        foreach ($request->request as $key => $value) {
            if ($key == "_token") {
                continue;
            }
            $data += [$key => $value];
        }
        try {
            User::query()->where('id', Auth::id())->update($data);
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Cập nhật thông tin thất bại");
        }
        return redirect()->back()->with("success", "Cập nhật thông tin thành công");
    }
}