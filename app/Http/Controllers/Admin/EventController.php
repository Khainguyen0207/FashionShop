<?php

namespace App\Http\Controllers\admin;

use App\Models\EventModel;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\RenderController;
use App\Http\Controllers\FunctionController;

class EventController extends Controller
{
    public function home() {
        $keyTable = ['id', 'title' , 'start_time', 'end_time'];
        $table = FunctionController::table('event', $keyTable); //Setting table
        $body = EventModel::query()->paginate(10);
        $render = [
            $table,
            $body->items(),
            $keyTable,
            $body->currentPage(),
            $body->lastPage()
        ];
        $render['icon'] = null;
        $render['custom_button'] = ['info' => 'fa-solid fa-info'];
        return view("admin.event", RenderController::render("event", $render));
    }

    public function store(EventRequest $request) {
        $render = [

        ];
        dd($request);
    }
}
