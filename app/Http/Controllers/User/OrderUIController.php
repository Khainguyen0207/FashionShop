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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Chart\Layout;

use function Laravel\Prompts\alert;

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
            foreach ($product as $product_key => $product_value) {
                $image = Product::query()->where('product_code', $product_value['id'])->first('image');
                
                if (Storage::exists($image->image)) {
                    $product[$product_key]['image'] = Storage::url($image->image);
                } else {
                    $product[$product_key]['image'] = asset("assets/user/img/box.png");
                }
                $total += $product[$product_key]['price_product'];
            }
            $orders[$id] = array(
                'order_code' => $products[$key]['order_code'],
                'recipient_name' => $products[$key]['recipient_name'],
                'number_phone' => $products[$key]['number_phone'],
                'address' => $products[$key]['address'],
                'products' => $product,
                'total' => $total,
            );
        }
        
        $render = [
            'title' => FunctionController::status_order($status),
            'status' => $this->getCodeStatus($request->status),
            'orders' => $orders,
        ];
        return view('layouts.components.order-in-profile', $render);
    }

    public function destroy(Request $request) {
        try {
            OrderModel::query()->where('order_code', $request->id)->delete();
        } catch (\Throwable $th) {
            Log::error('Error Database SQL', ['messgae' => $th->getMessage()]);
            return redirect()->back()->with('success', "Hủy đơn hàng thất bại");
        }
        session()->flash('success', 'Hủy đơn hàng thành công');
        return view('common.error');
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
