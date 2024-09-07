<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class PayController extends Controller
{
    public function index() {
        $products = json_decode(request()->query('products'), true);
        if (empty($products)) {
            return redirect()->back()->with('error', "Vui lòng chọn sản phẩm thanh toán ở giỏ hàng");
        }
        $render = [
            'products' => $products
        ];
        return view('user.pay', $render);
    }
    
    public function store(Request $request) {
        
    }
}
