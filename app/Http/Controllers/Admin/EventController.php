<?php

namespace App\Http\Controllers\admin;

use App\Models\EventModel;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\RenderController;
use App\Http\Controllers\FunctionController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function home() {
        $keyTable = ['id','image', 'title' , 'start_time', 'end_time', 'status'];
        $table = FunctionController::table('event', $keyTable); //Setting table
        $body = EventModel::query()->paginate(10);
        foreach (collect($body->items()) as $key => $value) {
            $value->image = url(Storage::url($value->image) );
        }
        $render = [
            $table,
            $body->items(),
            $keyTable,
            $body->currentPage(),
            $body->lastPage(),
            route("admin.event.home")
        ];

        $render['icon'] = null;
        $render['custom_button'] = FunctionController::button(['info','del']);
        return view("admin.event", RenderController::render("event", $render));
    }

    public function store(EventRequest $request) {
        $render = [
            "image" => $request->file("banner_event")->store('public/events'),
            ...$request->input()
        ];
        try {
            EventModel::query()->create($render);
        } catch (\Throwable $th) {
            Log::error("SQL_eror", [
                "message" => $th
            ]);
        }
        return redirect()->back()->with("success", "Thêm mới sự kiện thành công");
    }

    public function show(Request $request, string $id) {
        $information = EventModel::query()->where('id', $id)->get();
        return view('layouts.admin.event_seen_info', ...$information);
    }

    public function destroy($id) {
        dd($id);
    }
}