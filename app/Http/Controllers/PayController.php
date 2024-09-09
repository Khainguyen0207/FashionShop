<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayController extends Controller
{
    public function index() {
        return view('user.cart')->with('error','Vui lòng chọn sản phẩm thanh toán ở giỏ hàng');
    }
    
    public function store(Request $request) {
        $products = json_decode(request()->products, true);
        $sum = 0;
        if (empty($products)) {
            return redirect()->back()->with('error','Vui lòng chọn sản phẩm thanh toán ở giỏ hàng');
        }
        foreach ($products as $key => $value) {
            $sum += $value['price_product'] * 1000;
        }
        $render = [
            'products' => $products,
            'sum_total' => number_format($sum, 0, ",", ".") 
        ];
        return view('user.pay', $render);
    }

    public function show($render) {
        
    }
}