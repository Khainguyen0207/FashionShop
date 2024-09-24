<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionController;
use App\Models\OrderModel;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Chart\Layout;

class OrderUIController extends Controller
{
    public function index(array $products = null)
    {
        $user = User::query()->where('id', Auth::id())->first();
        $information = $user->attributesToArray();
        if (Storage::exists($information['avatar'])) {
            $information['avatar'] = Storage::url($information['avatar']);
        } else {
            $information['avatar'] = asset('assets/user/img/box.png');
        }
        $render = [
            'avatar' => $information['avatar'],
            'products' => Session::get('cart'),
        ];

        return view('user.profile.order', $render);
    }

    public function store(Request $request)
    {
        return view('user.profile.order');
    }

    public function show(Request $request) {
        $status = $this->getCodeStatus($request->status);
        $products = OrderModel::query()->where(['customer_id' => Auth::id(), 'status' => $status])->get();
        $orders = [];
        foreach ($products->toArray() as $key => $value) {
            $id = $products[$key]['order_code'];
            $product = json_decode($products[$key]['order_information'], true);
            $total = 0;
            foreach ($product as $key => $value) {
                $image = Product::query()->where('product_code', $value['id'])->first('image');
                
                if (Storage::exists($image->image)) {
                    $product[$key]['image'] = Storage::url($image->image);
                } else {
                    $product[$key]['image'] = asset("assets/user/img/box.png");
                }
                $total += $product[$key]['price_product'];
            }
            
            $data_order = [
                'order_code' => $products[$key]['order_code'],
                'recipient_name' => $products[$key]['recipient_name'],
                'number_phone' => $products[$key]['number_phone'],
                'address' => $products[$key]['address'],
                'products' => $product,
                'total' => $total,
            ];
            $orders[$id] = $data_order;
        }
        
        $render = [
            'title' => FunctionController::status_order($status),
            'orders' => $orders,
        ];
        return view('layouts.components.order-in-profile', $render);
    }

    private function getCodeStatus(string $status) : string {
        switch ($status) {
            case 'confirm':
                return "00";
            case 'transit':
                return "01";
            case 'delivered':
                return "02";
        }
    }
}
