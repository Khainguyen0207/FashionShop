<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToArray;

class ProductUIController extends Controller
{
    public function index() {
        $products = Product::query()
            ->inRandomOrder()
            ->paginate(10);
        $max_page = $products->lastPage();
        $products = $this->getUrlForImage($products->items());
        $render = [
            'products' => $products,
            'category_name' => 'Sản phẩm',
            'url' => route('products.home.post', ['product' => count($products)]),
            'max_page' => $max_page 
        ];
        return view('user.products', $render);
    }

    public function store(Request $request) {
        $products_hided = Session::get('products_hided'); //Lấy các product đã hiện
        $id_products_hided = Session::get('id_products_hided'); //Lấy các product đã hiện

        $products = Product::query()
            ->whereNotIn('id', $id_products_hided)
            ->inRandomOrder();
        if (isset($request->i)) {
            $products->where('category_id', $request->i);
        }
        $products = $products->paginate(10); // Lấy 10 sản phẩm
        $max_page = $products->lastPage();
        $products = $this->getUrlForImage($products->items());
        Session::flash('id_products_hided', array_merge($id_products_hided, Session::get('id_products_hided')));
        Session::flash('products_hided', array_merge($products_hided, Session::get('products_hided')));

        $products = array_merge($products_hided, $products);
        $render = [
            'products' => $products,
            'url' => route('products.home.post', ['product' => count($products), 'i' => $request->i]),
            'max_page' => $max_page,
        ];
        return view('layouts.user.list-products', $render);
    }

    public function show_products($category_id) {
        $products = Product::query()
            ->where('category_id', $category_id)
            ->inRandomOrder()
            ->paginate(10);
        $max_page = $products->lastPage();
        $name_category = Category::query()->where('id', $category_id)->first('name_category');
        
        if(!isset($name_category)) {
            return abort(404);
        }

        $products = $this->getUrlForImage($products->items());

        $render = [
            'products' => $products,
            'category_name' => $name_category->name_category,
            'url' => route('products.home.post', ['product' => count($products), 'i' => $category_id]),
            'max_page' => $max_page
        ];

        return view('user.products', $render);
    }

    public function show($category_id, $product_id) {
        $product = Product::query()->where('id', $product_id)->first();
        if(!isset($product)) {
            return abort(404);
        }
        $data_image = [];
        foreach (explode('|', $product['image']) as $key => $value) {
            if (Storage::disk('public')->exists($value)) {
                $data_image += array($key => Storage::url($value));
            } else {
                $data_image += array(asset('assets/user/img/box.png'));
            }
        }
        $product['image'] = $data_image;
        $product['price'] = number_format( $product['price'], 0, ',', '.');
        $product['description'] = explode("\n", $product['description']);
        $url_back = $_SERVER['HTTP_REFERER'];
        $render = [
            'product' => $product,
            'url_back' => $url_back,
        ];
        return view('user.product', $render);
    }

    public function render() {
        
    }

    private function getUrlForImage($products) {
        $products_hide = [];
        $id_products_hide = [];
        foreach ($products as $key => $product) {
            $data_image = [];
            foreach (explode('|', $product['image']) as $key => $value) {
                if (Storage::disk('public')->exists($value)) {
                    $data_image += array($key => Storage::url($value));
                } else {
                    $data_image += array(asset('assets/user/img/box.png'));
                }
            }
            $product['image'] = $data_image;
            $product['price'] = number_format($product['price'], 0, ',', '.');
            array_push($products_hide, $product);
            array_push($id_products_hide, $product->id);
        }
        Session::flash('products_hided', $products_hide);
        Session::flash('id_products_hided', $id_products_hide);
        return $products;
    }
}

