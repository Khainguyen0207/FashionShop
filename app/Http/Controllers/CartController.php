<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function index()
    {
        $render = [
            'products' => Session::get('cart'),
        ];

        return view('user.cart', $render);
    }

    public function store(Request $request, $product_id)
    {
        if (session()->get('cart') != null && array_key_exists($product_id, session()->get('cart'))) {
            return redirect(url()->previous())->with('error', 'Sản phẩm đã được thêm vào trước đó');
        }
        $product = Product::query()->where('id', $product_id)->first()->attributesToArray();

        $data_image = [];
        foreach (explode('|', $product['image']) as $key => $value) {
            if (Storage::disk('public')->exists($value)) {
                $data_image += [$key => Storage::url($value)];
            } else {
                $data_image += [asset('assets/user/img/box.png')];
            }
        }

        $product['quantity'] = 1;
        $product['image'] = $data_image;
        $cart = session()->get('cart', []);
        $cart[$product_id] = $product;
        session()->put('cart', $cart);

        return redirect(url()->previous())->with('success', 'Sản phẩm được thêm vào giỏ hàng');
    }

    public function destroy($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);

        return $this->index();
    }
}
