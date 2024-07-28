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

    public function store(Request $request) {
        $nameCategory = $request->input('name_category');
        $description = $request->input('description');
        if (isset($nameCategory)) {
            try {
                trim($nameCategory);
                trim($description);
                $data = [
                    'name_category' => $nameCategory, 
                    'description' => $description, 
                ];  
                DB::table('categories')->insert($data);
            } catch (\Throwable $th) {
               dd($th);
            }
        }
        return redirect($_SERVER['HTTP_REFERER']);
    }
}
