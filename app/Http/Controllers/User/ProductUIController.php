<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductUIController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->inRandomOrder()
            ->paginate(MAX_PAGE_LOAD);
        $max_page = $products->total();
        $products = $this->getUrlForImage($products->items());
        $render = [
            'products' => $products,
            'category_name' => 'Sản phẩm',
            'url' => route('products.home.post', ['product' => count($products)]),
            'max_page' => $max_page,
        ];
        Session::flash('url_back', url()->current());
        if (! empty(request()->query('search'))) {
            $render['url'] = route('products.home.post', ['product' => count($products), 'search' => request()->query('search')]);
        }

        return view('user.products', $render);
    }

    public function store(Request $request)
    {
        $products_hided = Session::get('products_hided'); //Lấy các product đã hiện
        $id_products_hided = Session::get('id_products_hided'); //Lấy các product đã hiện
        $products = Product::whereNotIn('id', $id_products_hided)->inRandomOrder();

        if (! empty($request->query('i'))) {
            $category_id = $request->query('i');
            $products->where('category_id', $category_id);
        }

        if (! empty(request()->query('search'))) {
            $products->where('product_name', 'LIKE', '%'.request()->query('search').'%');
        }

        // Lấy 10 sản phẩm
        $products = $products->paginate(MAX_PAGE_LOAD);
        $max_page = $products->total();
        $products = $this->getUrlForImage($products->items());
        Session::flash('id_products_hided', array_merge($id_products_hided, Session::get('id_products_hided')));
        Session::flash('products_hided', array_merge($products_hided, Session::get('products_hided')));
        $products = array_merge($products_hided, $products);
        $render = [
            'products' => $products,
            'url' => route('products.home.post', ['product' => count($products), 'i' => $request->i]),
            'max_page' => $max_page,
        ];

        if (! empty(request()->query('search'))) {
            $render['url'] = route('products.home.post', ['product' => count($products), 'i' => $request->i, 'search' => request()->query('search')]);
        }

        return view('layouts.user.list-products', $render);
    }

    public function show_products($category_id)
    {
        $products = Product::query()
            ->where('category_id', $category_id)
            ->inRandomOrder()
            ->paginate(MAX_PAGE_LOAD);
        $max_page = $products->total();

        $name_category = Category::query()->where('id', $category_id)->first('name_category');

        if (!isset($name_category)) {
            return abort(404);
        }
        $products = $this->getUrlForImage($products->items());

        $render = [
            'products' => $products,
            'category_name' => $name_category->name_category,
            'url' => route('products.home.post', ['product' => count($products), 'i' => $category_id]),
            'max_page' => $max_page,
        ];
        if (! empty(request()->query('search'))) {
            $render['url'] = route('products.home.post', ['product' => count($products), 'i' => $category_id, 'search' => request()->query('search')]);
        }
        Session::flash('url_back', url()->current());

        return view('user.products', $render);
    }

    public function show($category_id, $product_id)
    {
        $product = Product::query()->where('id', $product_id)->first();
        $products = Product::query()
            ->inRandomOrder()
            ->paginate(MAX_PAGE_LOAD);
        $max_page = $products->total();
        $products = $this->getUrlForImage($products->items());
        if (! isset($product)) {
            return abort(404);
        }
        $data_image = [];
        foreach (explode('|', $product['image']) as $key => $value) {
            if (Storage::disk('public')->exists($value)) {
                $data_image += [$key => Storage::url($value)];
            } else {
                $data_image += [asset('assets/user/img/box.png')];
            }
        }
        $product['image'] = $data_image;
        $product['price'] = $product['price'];
        $product['description'] = explode("\n", $product['description']);
        $url_back = url()->previous();
        $render = [
            'product' => $product,
            'products' => $products,
            'url_back' => $url_back,
            'max_page' => $max_page,
            'url' => route('products.home.post', ['product' => count($products), 'i' => $category_id, 'search' => request()->query('search')]),
        ];

        return view('user.product', $render);
    }

    public function arrange(Request $request)
    {
        $products = Session::get('products_hided');
        Session::reflash();

        if ($request->arrange != 'buy_much') {
            $prices = array_column($products, 'price'); // Lấy cột giá
            array_multisort($prices, $this->getCodeSort($request->arrange), $products); // Sắp xếp sản phẩm theo giá tăng dần or giảm dần
        } else {
            $prices = array_column($products, 'sold_quantity'); // Lấy cột giá
            array_multisort($prices, SORT_DESC, $products); // Sắp xếp sản phẩm theo giá tăng dần or giảm dần
        }

        $render = [
            'products' => $products,
            'url' => route('products.home.post', ['product' => count($products)]),
            'max_page' => $request->max_page,
        ];

        return view('layouts.user.list-products', $render);
    }

    private function getCodeSort($status_sort)
    {
        if ($status_sort == 'desc') {
            return SORT_DESC;
        } elseif ($status_sort == 'asc') {
            return SORT_ASC;
        }
        return abort(500);
    }

    public function getSizeAndColor() {
        $product = Product::findOrFail(request()->input("id"));
        return response()->json(
            [
                "sizes" => $product->sizes,
                "colors" => $product->colors
            ]
        );
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
