<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionController;
use App\Models\OrderModel;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class OrderUIController extends Controller
{
    public function index(?array $products = null)
    {
        $user = User::query()->where('id', Auth::id())->first();
        $query = OrderModel::where('customer_id', Auth::id());

        $confirm = (clone $query)->where('status', '00')->count();
        $transit = (clone $query)->where('status', '01')->count();
        $delivered = (clone $query)->where('status', '02')->count();

        $information = $user->attributesToArray();
        if (! empty($information['avatar']) && Storage::exists($information['avatar'])) {
            $information['avatar'] = Storage::url($information['avatar']);
        } else {
            $information['avatar'] = asset('assets/user/img/box.png');
        }
        $render = [
            ...$information,
            'confirm' => $confirm,
            'transit' => $transit,
            'delivered' => $delivered,
            'products' => Session::get('cart'),
        ];

        return view('user.profile.order', $render);
    }

    public function store(Request $request)
    {
        return view('user.profile.order');
    }

    public function show(Request $request)
    {
        $status = $this->getCodeStatus($request->status);
        $products = OrderModel::query()->where(['customer_id' => Auth::id(), 'status' => $status])->get();
        $orders = [];
        foreach ($products->toArray() as $key => $value) {
            $id = $products[$key]['order_code'];
            $product = json_decode($products[$key]['order_information'], true);
            $total = 0;
            foreach ($product as $product_key => $product_value) {
                $image = Product::query()->where('product_code', $product_value['id'])->first();
                if (!is_null($image) && Storage::exists("public/" .$image->image)) {
                    $product[$product_key]['image'] = url(Storage::url($image->image));
                } else {
                    $product[$product_key]['image'] = asset('assets/user/img/box.png');
                }
                $product[$product_key]['category_id'] = $image->category_id;
                $product[$product_key]['product_id'] = $image->id;
                $total += $product[$product_key]['price_product'];
            }
            $orders[$id] = [
                'order_code' => $products[$key]['order_code'],
                'recipient_name' => $products[$key]['recipient_name'],
                'number_phone' => $products[$key]['number_phone'],
                'address' => $products[$key]['address'],
                'products' => $product,
                'total' => $total,
            ];
        }

        $render = [
            'title' => FunctionController::status_order($status),
            'status' => $this->getCodeStatus($request->status),
            'orders' => $orders,
        ];

        return view('layouts.components.order-in-profile', $render);
    }

    public function destroy(Request $request)
    {
        try {
            OrderModel::query()->where('order_code', $request->id)->update(['status' => '20']);
        } catch (\Throwable $th) {
            Log::error('Error Database SQL', ['messgae' => $th->getMessage()]);

            return redirect()->back()->with('success', 'Hủy đơn hàng thất bại');
        }
        session()->flash('success', 'Hủy đơn hàng thành công');

        return view('common.error');
    }

    private function getCodeStatus(string $status): string
    {
        switch ($status) {
            case 'confirm':
                return '00';
            case 'transit':
                return '01';
            case 'delivered':
                return '02';
        }
    }
}
