<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home() {
        $account = Auth::user();
        $categories = Category::query()->get(['id', 'name_category'])->toArray();
        foreach ($categories as $key => $value) {
            $categories[$key]["products"] = Product::query()->where('category_id', $value['id'])->inRandomOrder()->paginate(5)->items();
        }
        dd($categories);
        $render = [
            'title' => 'Trang chủ',
            'categories' => $categories,
            'products' => $categories,
            'name' => $account->name,
            'role' => $account->role,

        ];
        return view('user.home', $render);
    }

    public function store(Request $request) {
        return "Hello";
    }

    public function destroy()  {
        Auth::logout();
        return redirect('auth');
    }
}
