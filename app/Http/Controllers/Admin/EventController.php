<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RenderController;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function home() {
        $keyTable = ['id', 'title' , 'start_time', 'end_time', 'information'];
        // $table = FunctionController::table('event', $keyTable); //Setting table
        $data = [
        ];
        return view("admin.event", RenderController::render("event", $data));
    }

    public function store(Request $request) {
        dd($request);
    }
}
