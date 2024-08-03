<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
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
        $data = DB::table('categories')->select('name_category', 'id')->where('id', $id_category)->get();
        $nameCategory = $data->first()->name_category;
        $id = $data->first()->id;
        return view('admin.categories.products', ['name_category' => $nameCategory, 'id' => $id ]);
    }

    public function store(Request $request) { //Request để ý bảo mật cao hơn
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
                Category::query()->create($data);
            } catch (\Throwable $th) {
               dd($th);
            }
        }
        return redirect($_SERVER['HTTP_REFERER']);
    }
}
