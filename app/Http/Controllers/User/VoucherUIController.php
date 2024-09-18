<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoucherUIController extends Controller
{
    public function index() {
        return view('user.profile.voucher');
    }

    public function store(Request $request) {
        return view('user.profile.voucher');
    }
}
