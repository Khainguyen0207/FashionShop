<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RankUIController extends Controller
{
    public function index() {
        return view('user.profile.rank');
    }

    public function store(Request $request) {
        return view('user.profile.rank');
    }
}
