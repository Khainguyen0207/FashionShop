<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class PayController extends Controller
{
    public function index() {
        $products = json_decode(request()->query('products'), true);
        $sum = 0;
        if (empty($products)) {
            return redirect()->back()->with('error', "Vui lòng chọn sản phẩm thanh toán ở giỏ hàng");
        }
        foreach ($products as $key => $value) {
            $sum += $value['price_product'];
        }
        $render = [
            'products' => $products,
            'sum_total' => number_format($sum * 1000, 0, ',', '.')
        ];
        return view('user.pay', $render);
    }
    
    public function store(Request $request) {
        
    }
}
