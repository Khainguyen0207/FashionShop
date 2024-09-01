<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToArray;

class ProductUIController extends Controller
{
    public function index() {
        $products = Product::query()->paginate(10)->items();
        foreach ($products as $product) {
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
        }
        $render = [
            'products' => $products,
            'category_name' => 'Sản phẩm',
        ];
        return view('user.products', $render);
    }

    public function show_products($category_id) {
        $products = Product::query()->where('category_id', $category_id)->paginate(10)->items();
        $name_category = Category::query()->where('id', $category_id)->first('name_category');
        if(!isset($name_category)) {
            return abort(404);
        }
        foreach ($products as $product) {
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
        }
        $render = [
            'products' => $products,
            'category_name' => $name_category->name_category,
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
        $render = [
            'product' => $product,
            'url_back' => $_SERVER['HTTP_REFERER'],
        ];
        return view('user.product', $render);
    }
}
