<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderUIController extends Controller
{
    public function index() {
        return view('user.profile.order');
    }

    public function store(Request $request) {
        return view('user.profile.order');
    }
}
