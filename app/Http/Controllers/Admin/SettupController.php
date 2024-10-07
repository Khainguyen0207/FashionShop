<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RenderController;

class SettupController extends Controller
{
    public function home() {
        $data = [];
        return view("admin.setting", RenderController::render('settup', $data));
    }
}
