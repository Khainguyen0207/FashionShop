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
        foreach ($body as $key => $value) {
            if ($value->end_time > Carbon::now() && $value->start_time < Carbon::now()) {
                $value->status = "Hoạt động";
            } else if($value->start_time > Carbon::now()) {
                $value->status = "Sắp diễn ra";
            } else {
                $value->status = "Hết hạn";
            }
            $value->image = url(Storage::url($value->image));
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
        $render['custom_button'] = FunctionController::button(['edit','del']);
        return view("admin.event", RenderController::render("event", $render));
    }

    public function store(EventRequest $request) {
        $start_time = $request->input("start_time");
        $end_time = $request->input("end_time");
        if ($start_time > $end_time) {
            return redirect()->back()->with("error", "Thời gian bắt đầu phải nhỏ hơn kết thúc");
        }
        $render = [
            "image" => $request->file("image")->store('public/events'),
            ...$request->input()
        ];
        try {
            EventModel::query()->create($render);
        } catch (\Throwable $th) {
            Log::error("SQL_eror", [
                "message" => $th
            ]);
            return redirect()->back()->with("error", "Thêm mới sự kiện thất bại");
        }
        return redirect()->back()->with("success", "Thêm mới sự kiện thành công");
    }

    public function edit(string $id) {
        $event = EventModel::query()->where('id',$id)->first();
        $event->start_time = Carbon::parse($event->start_time)->format("Y-m-d");
        $event->end_time = Carbon::parse($event->end_time )->format("Y-m-d");
        $event->image = url(Storage::url($event->image));
        return view('layouts.admin.event_seen_info', $event);
    }

    public function update(Request $request, string $id) {
        $info = EventModel::findOrFail($id);  
        $info->fill($request->all());
        if ($info->isDirty()) {
            if ($info->isDirty("image")) {
                if (Storage::exists($info->image)) {
                    Storage::delete($info->image);
                }
                $info->image = $request->file("image")->store('public/events');
            }
            $info->save();
        }
        return back()->with("success", "Dữ liệu được cập nhật");
    }

    public function destroy($id) {
        $event = EventModel::query()->where('id', $id)->first();
        if (Storage::exists($event->image)) {
            Storage::delete($event->image);
        }
        $event->delete();
        return redirect()->back()->with("success", "Sự kiện đã được xóa");
    }
}