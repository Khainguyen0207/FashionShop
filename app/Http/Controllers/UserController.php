<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home() {
        $account = Auth::user();
        Product::query()
                ->where('category_id', '10')
                ->inRandomOrder()
                ->limit(5)
                ->get();
        $render = [
            'title' => 'Trang chủ',
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
