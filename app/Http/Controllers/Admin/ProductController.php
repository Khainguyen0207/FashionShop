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
    public function index() {
        $maxNumberPage = intdiv(count(DB::table('users')->get()), MAX_PAGE);
        $users = DB::table('users')->select('name','id','email', 'role')->take(15)->get(); //Lấy giá trị account
        $table = FunctionController::table('customer'); //Setting table
        $render = [$table, $users, 'number' => 0, 'maxPage' => $maxNumberPage];
        return view('admin.categories.products', RenderController::render('customer', $render));
    }
}
