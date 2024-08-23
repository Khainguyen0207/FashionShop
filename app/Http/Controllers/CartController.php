<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index() {
        Session::put('cart', [
            [
                'id' => 1,
                'name' => 'Nguyen Trong Khai',
            ], 
            [
                'id' => 2,
                'name' => 'Nguyen Trong Khai',
            ],
            [
                'id' => 3,
                'name' => 'Nguyen Trong Khai',
            ], 
            [
                'id' => 4,
                'name' => 'Nguyen Trong Khai',
            ], 
        ]);
        return view('user.cart');
    }
}
