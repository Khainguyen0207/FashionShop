<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\EventModel;
use Illuminate\Http\Request;

class EventBlogController extends Controller
{
    public function index() {
        return abort(404);
    }

    public function show($title_blog, $id_event) {
        $event = EventModel::query()->where('id', $id_event)->get()->toArray();
        if (empty($event)) {
            return abort(404);
        }
        return view("user.event", ...$event);
    }
}
