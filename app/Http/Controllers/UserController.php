<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function home() {
        $account = Auth::user();
        $categories = Category::query()->get(['id', 'name_category'])->toArray();
        foreach ($categories as $key => $value) {
            $categories[$key]["products"] = Product::query()->where('category_id', $value['id'])->inRandomOrder()->paginate(5)->items();
            $this->getUrlForImage($categories[$key]["products"]);
        }
        $render = [
            'title' => 'Trang chủ',
            'categories' => $categories,
            'name' => $account->name,
            'role' => $account->role,

        ];
        return view('user.home', $render);
    }

    public function store(Request $request) {
        return "Hello";
    }

    public function destroy()  {
        Auth::logout();
        return redirect('auth');
    }

    private function getUrlForImage($products) {
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
        }
        return $products;
    }
}
