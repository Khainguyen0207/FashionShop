<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RenderController;
use Illuminate\Http\Request;

class SettupController extends Controller
{
    public function home()
    {
        $data = [];

        return view('admin.setting', RenderController::render('settup', $data));
    }

    public function store(Request $request)
    {
        $data = [];

        return view('admin.setting', RenderController::render('settup', $data));
    }

    public function edit(Request $request)
    {
        $request->file('avatar');
        $data = [];

        return view('admin.setting', RenderController::render('settup', $data));
    }
}
