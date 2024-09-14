<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use function PHPSTORM_META\type;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RenderController;

use App\Http\Controllers\FunctionController;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpParser\Node\Stmt\Return_;

class OrderController extends Controller
{
    public function index() {
        return redirect(route("order.pending"));
    }

    public function pending_confirmation_orders() {
        $getOrders = OrderModel::query()
                            ->where("status", "00")
                            ->paginate(15);
        $render = $this->render_data_table($getOrders);
        $render['icon'] = ["fa-solid fa-check", 'fa-solid fa-xmark'];
        return view("admin.orderscheck", RenderController::render('order', $render));
    }

    public function order_in_transit() {
        $getOrders = OrderModel::query()->where('status', '01')->paginate(15);
        $render = $this->render_data_table($getOrders);
        $render['icon'] = ["fa-solid fa-check", 'fa-solid fa-xmark'];
        return view("admin.orderscheck", RenderController::render('order', $render));
    }

    public function orders() {
        $getOrders = OrderModel::query()->paginate(15);
        $render = $this->render_data_table($getOrders);
        $render['icon'] = null;
        return view("admin.orderscheck", RenderController::render('order', $render));
    }

    public function render_data_table(LengthAwarePaginator $getOrders) : array {
        $keyTable = ['order_code','recipient_name','number_phone', 'status', 'expired_at'];
        $table = FunctionController::table('order', $keyTable); //Setting table
        $orders = $getOrders->items();
        foreach ($orders as $key => $item) {
            $orders[$key] = collect($orders[$key])->toArray();
            $orders[$key]['status'] = FunctionController::status_order($orders[$key]['status']);
            $orders[$key]['expired_at'] = Carbon::instance($getOrders->items()[$key]['expired_at'])->format('Y-m-d H:i:s');
        }
        
        $render = [
            'table' => $table,
            'orders' => $orders,
            'key_table' => $keyTable,
            'number' => $getOrders->currentPage(),
            'maxNumberPage' => $getOrders->lastPage(),
            'url' => $getOrders->path()
        ];
        return $render;
    }
}
