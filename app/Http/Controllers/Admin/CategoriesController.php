<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
                return redirect(route('categories.home'))->with(['success' => 'Thêm danh mục thất bại']);
            }
        }
        return redirect(route('categories.home'))->with(['success' => 'Thêm danh mục thành công']);
    }

    public function destroy($id_category) {
        $info = DB::table('categories')->where('id', $id_category)->get();
        $deleted = DB::table('categories')->where('id', $id_category)->delete();
        $date = Carbon::now();
        if ($deleted) {
            fwrite(fopen('UpdateDataBase.txt', 'a'), "Delete categories: $info \nIn table 'categories' =>  Time $date\n");
        }
        return redirect(route('categories.home'));
    }
}
