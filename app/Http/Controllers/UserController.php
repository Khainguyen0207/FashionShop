<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function home()
    {
        $account = Auth::user();
        $categories = Category::query()->get(['id', 'name_category'])->toArray();
        foreach ($categories as $key => $value) {
            $categories[$key]['products'] = Product::query()->where('category_id', $value['id'])->inRandomOrder()->paginate(5)->items();
            $this->getUrlForImage($categories[$key]['products']);
        }
        $render = [
            'title' => 'Trang chủ',
            'categories' => $categories,
        ];

        if (!empty($account)) {
            $render += [
                'name' => $account->name,
                'role' => $account->role,
            ];
        }
        return view('user.home', $render);
    }

    public function store(Request $request)
    {
        $search = trim($request->query('search'));
        $products = Product::where("product_name", 'LIKE', '%'.$search.'%')->paginate(10);
        $max_page = $products->total();
        $products = $this->getUrlForImage($products->items());
        $render = [
            'products' => $products,
            'category_name' => 'Sản phẩm',
            'url' => route('products.home.post', ['product' => count($products)]),
            'max_page' => $max_page,
        ];
        Session::flash('url_back', url()->current());
        return view('user.products', $render);
    }

    public function destroy()
    {
        Auth::logout();
        return redirect(route("user.home"));
    }

    private function getUrlForImage($products)
    {
        $products_hide = [];
        $id_products_hide = [];
        foreach ($products as $key => $product) {
            $data_image = [];
            foreach (explode('|', $product['image']) as $key => $value) {
                if (Storage::disk('public')->exists($value)) {
                    $data_image += [$key => Storage::url($value)];
                } else {
                    $data_image += [asset('assets/user/img/box.png')];
                }
            }
            $product['image'] = $data_image;
            array_push($products_hide, $product);
            array_push($id_products_hide, $product->id);
        }
        Session::flash('products_hided', $products_hide);
        Session::flash('id_products_hided', $id_products_hide);
        return $products;
    }
}
