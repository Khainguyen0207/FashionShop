<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RenderController;
use App\Http\Controllers\FunctionController;

const MAX_PAGE = 15;
class ProductController extends Controller
{
    private $id;
    private $name_category;
    public function index() {
        $users = DB::table('users')->select('name','id','email', 'role')->take(15)->get(); //Lấy giá trị account
        $table = FunctionController::table('product'); //Setting table
        $render = [$table, $users, 'name_category' => $this->name_category, 'id' => $this->id , 'number' => 0, 'maxPage' => MAX_PAGE];
        return view('admin.categories.products', RenderController::render('product', $render));
    }

    public function view($id_category) {
        $this->id = $id_category;
        $data = DB::table('categories')->select('name_category', 'id')->where('id', $id_category)->get();
        $this->name_category = $data->first()->name_category;
        return $this->index();
    }
}
