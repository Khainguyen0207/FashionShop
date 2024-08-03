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

    public function home() {
        return redirect(route('categories.home'));
    }
    public function index($id_category) {
        $this->name_category = DB::table('categories')->where('id', '=', $id_category)->select('name_category')->get()->first()->name_category;
        $keyTable = [
            'product_name',
            'product_code',
            'price',
            'category_name',
            'number_items'
        ];
        $maxNumberPage = intdiv(count(DB::table('products')->where('products.category_id', '=', $id_category)->get()), MAX_PAGE);
        $table = FunctionController::table('product', $keyTable);
        $users = DB::table('products')
            ->where('products.category_id', '=', $id_category)
            ->select('id', 'product_code', 'product_name', 'category_id', 'price', 'unsold_quantity', 'sold_quantity')
            ->take(15)
            ->get();
        $users = json_decode($users, true);
        foreach ($users as $index => $account) {
            $change_id_to_name = DB::table('products')
            ->where('products.category_id', '=', $id_category)
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('name_category')
            ->get()
            ->first();
            $users[$index]['category_name'] = $change_id_to_name->name_category;
        }
        $render = [$table, $users, $keyTable, 'name_category' => $this->name_category, 'id' => $id_category , 'number' => 0, 'maxPage' => $maxNumberPage];
        return view('admin.categories.products', RenderController::render('product', $render));
    }

    public function page($id_category, $page)
    {
        $keyTable = [
            'product_name',
            'product_code',
            'price',
            'category_name',
            'number_items'
        ];

        $table = FunctionController::table('product', $keyTable);
        $maxNumberPage = intdiv(count(DB::table('products')->where('products.category_id', '=', $id_category)->get()), MAX_PAGE);
        $number = MAX_PAGE * $page;
        $users = DB::table('products')
        ->where('products.category_id', '=', $id_category)
        ->select('id', 'product_code', 'product_name', 'category_id', 'price', 'unsold_quantity', 'sold_quantity')
        ->skip($number)
        ->take(MAX_PAGE)
        ->get();
        $users = json_decode($users, true);
        foreach ($users as $index => $account) {
            $change_id_to_name = DB::table('products')
            ->where('products.category_id', '=', $id_category)
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('name_category')
            ->get()
            ->first();
            $users[$index]['category_name'] = $change_id_to_name->name_category;
        }
        $render = [$table, $users, $keyTable, 'name_category' => $this->name_category, 'id' => $id_category , 'number' => $page, 'maxPage' => $maxNumberPage];
        return view('admin.categories.products', RenderController::render('product', $render));
    }
}
