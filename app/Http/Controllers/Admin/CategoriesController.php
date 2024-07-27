<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function home() {
        $data = DB::table('categories')->select('id', 'name_category')->get();

        $render = [
            'title' => '',
            'categories' => $data->toArray(),
        ];
        return view('admin.categories', $render);
    }

    public function view($id_category) {
        return view('admin.categories.products');
    }
}
