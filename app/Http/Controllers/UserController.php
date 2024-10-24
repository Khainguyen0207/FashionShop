<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function home()
    {
        $product = Product::query();
        $products_new = $product->latest()->whereMonth('created_at', Carbon::now()->monthOfYear())->paginate(10)->items();
        $products_new = $this->getUrlForImage($products_new);
        $account = Auth::user();
        $categories = Category::query()->get(['id', 'name_category'])->toArray();
        foreach ($categories as $key => $value) {
            $categories[$key]['products'] = Product::query()->where('category_id', $value['id'])->inRandomOrder()->paginate(5)->items();
            $this->getUrlForImage($categories[$key]['products']);
        }
        $render = [
            'title' => 'Trang chủ',
            'categories' => $categories,
            'products_new' => $products_new
        ];

        if (! empty($account)) {
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
        $products = Product::where('product_name', 'LIKE', '%'.$search.'%')->paginate(MAX_PAGE_LOAD);
        $max_page = $products->total();
        $products = $this->getUrlForImage($products->items());
        $render = [
            'products' => $products,
            'category_name' => 'Sản phẩm',
            'url' => route('products.home.post', ['product' => count($products), 'search' => $request->query('search')]),
            'max_page' => $max_page,
        ];
        Session::flash('url_back', url()->current());
        if (empty($products)) {
            return view('user.products', $render)->with('error', 'Không có sản phẩm nào bạn có thể xem sản phẩm khacs');
        }

        return view('user.products', $render);
    }

    public function destroy()
    {
        Auth::logout();

        return redirect(route('user.home'));
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
