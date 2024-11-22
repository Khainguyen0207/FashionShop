<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Exists;

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
        if (empty($request->query('color')) || empty($request->query('size'))) {
            session()->flash('error', 'Vui lòng chọn kích thước và màu sắc');

            return url()->previous();
        }
        if (session()->get('cart') != null && array_key_exists($product_id, session()->get('cart'))) {
            session()->flash('error', 'Sản phẩm đã được thêm vào trước đó');

            return url()->previous();
        }

        $product = Product::query()->findOrFail($product_id);
        $data_image = [];
        foreach (explode('|', $product->image) as $key => $value) {
            if (Storage::disk('public')->exists($value)) {
                $data_image += [$key => url(Storage::url($value))];
            } else {
                $data_image += [asset('assets/user/img/box.png')];
            }
        }
        $product->image = $data_image;
        $product->quantity = 1;
        try {
            $colors = json_decode($product->colors, true);
            $sizes = json_decode($product->sizes, true);
            if (key_exists($request->query('color'),  $colors) && key_exists($request->query('size'), $sizes)) {
                $product->product_color = $request->query('color');
                $product->product_size = $request->query('size');
                $product->price += $colors[$request->query('color')] + $sizes[$request->query('size')];
            } else {
                throw new Exception('Vui lòng chọn kích thước và màu sắc', 1);
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Vui lòng chọn kích thước và màu sắc');
            return url()->previous();
        }
        $cart = session()->get('cart', []);
        $cart[$product_id] = $product;
        session()->put('cart', $cart);
        return session()->flash('success', 'Tuyệt vời! Sản phẩm được thêm vào giỏ hàng');
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
