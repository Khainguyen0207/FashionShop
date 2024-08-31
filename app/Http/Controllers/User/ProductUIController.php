<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
                $data_image += array($key => Storage::url($value));
            }
            $product['image'] = $data_image;
            $product['price'] = number_format( $product['price'], 0, ',', '.');
        }
        $render = [
            'products' => $products,
            'category_name' => 'Thời trang nam',
        ];
        return view('user.products', $render);
    }

    public function show($product_id) {
        $product = Product::query()->where('id', $product_id)->first();
        $data_image = [];
        foreach (explode('|', $product['image']) as $key => $value) {
            $data_image += array($key => Storage::url($value));
        }
        $product['image'] = $data_image;
        $product['price'] = number_format( $product['price'], 0, ',', '.');
        $product['description'] = explode("\n", $product['description']);
        $render = [
            'product' => $product,
        ];
        return view('user.product', $render);
    }

    public function render() {
        
    }

}
