<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RankUIController extends Controller
{
    public function index()
    {
        $user = User::query()->where('id', Auth::id())->first();
        $information = $user->attributesToArray();
        if (!empty($information['avatar']) && Storage::exists($information['avatar'])) {
            $information['avatar'] = Storage::url($information['avatar']);
        } else {
            $information['avatar'] = asset('assets/user/img/box.png');
        }

        $render = [
            ...$information,
        ];

        return view('user.profile.rank', $render);
    }

    public function store(Request $request)
    {
        return view('user.profile.rank');
    }
}
