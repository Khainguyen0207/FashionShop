<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function home() {
        $render = ['title' => ''];
        return view('admin.categories', $render);
    }

    public function view($name_category) {
        return view('admin.categories.products');
    }



}
