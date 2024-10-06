<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionController;
use App\Http\Controllers\RenderController;
use App\Models\OrderModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;

class OrderController extends Controller
{
    public function index()
    {
        return redirect(route('order.pending'));
    }

    //Pending
    public function pending_confirmation_orders()
    {
        $search = request()->query();
        $getOrders = OrderModel::where(function ($query) use ($search) {
            foreach ($search as $key => $value) {
                if (Schema::hasColumn('orders', $key)) {
                    $query->orWhere($key, 'LIKE', '%'.$value.'%');
                }
            }
        })->where('status', '00')->paginate(15);
        if ($getOrders->currentPage() > $getOrders->lastPage()) {
            abort(404);
        }
        session()->flash('status', '00');
        $render = $this->render_data_table($getOrders);
        $render['icon'] = null;
        $render['custom_button'] = ['info' => 'fa-solid fa-info', 'edit' => 'fa-solid fa-check', 'del' => 'fa-solid fa-xmark'];

        return view('admin.orderscheck', RenderController::render('order', $render));
    }

    //order_in_transit
    public function order_in_transit()
    {
        $search = request()->query();
        $getOrders = OrderModel::where(function ($query) use ($search) {
            foreach ($search as $key => $value) {
                if (Schema::hasColumn('orders', $key)) {
                    $query->orWhere($key, 'LIKE', '%'.$value.'%');
                }
            }
        })->where('status', '01')->paginate(15);
        if ($getOrders->currentPage() > $getOrders->lastPage()) {
            abort(404);
        }
        session()->flash('status', '01');
        $render = $this->render_data_table($getOrders);
        $render['icon'] = null;
        $render['custom_button'] = ['info' => 'fa-solid fa-info', 'edit' => 'fa-solid fa-check', 'del' => 'fa-solid fa-xmark'];

        return view('admin.orderscheck', RenderController::render('order', $render));
    }

    //orders
    public function orders()
    {
        $search = request()->query();
        $getOrders = OrderModel::where(function ($query) use ($search) {
            foreach ($search as $key => $value) {
                if (Schema::hasColumn('orders', $key)) {
                    $query->orWhere($key, 'LIKE', '%'.$value.'%');
                }
            }
        })->paginate(15);
        if ($getOrders->currentPage() > $getOrders->lastPage()) {
            abort(404);
        }
        session()->flash('seen', true);
        $render = $this->render_data_table($getOrders);
        $render['icon'] = null;
        $render['custom_button'] = ['info' => 'fa-solid fa-info'];

        return view('admin.orderscheck', RenderController::render('order', $render));
    }

    public function show(Request $request, $order_id)
    {
        $information_order = OrderModel::query()->where('id', $order_id)->first()->attributesToArray();
        $information_order['order_information'] = json_decode($information_order['order_information'], true);
        $information_order['status'] = FunctionController::status_order($information_order['status']);
        // Chuyển đổi mảng thành Collection
        $collection = collect($information_order['order_information']);
        $total = $collection->sum('price_product');
        $information_order['expired_at'] = Carbon::parse($information_order['expired_at']);
        session()->reflash();

        return view('layouts.admin.order_seen_info', [
            ...$information_order,
            'id' => $order_id,
            'expired_at' => $information_order['expired_at']->format('Y-m-d H:i:s'),
            'total' => $total,
        ]);
    }

    public function edit(Request $request, $order_id)
    {
        $status_order = $this->status_order('edit');
        OrderModel::query()->where('id', $order_id)->update(['status' => $status_order, 'expired_at' => now()]);

        return redirect()->back()->with('success', 'Đã duyệt đơn hàng');
    }

    public function destroy($order_id)
    {
        $status_order = $this->status_order('destroy');
        OrderModel::query()->where('id', $order_id)->update(['status' => $status_order, 'expired_at' => now()]);

        return redirect()->back()->with('success', 'Đã hủy đơn hàng');
    }

    private function status_order($info)
    {
        $status = session()->get('status');
        if ($info == 'edit') {
            switch ($status) {
                case '00': return '01';
                case '01': return '02';
                case '02': return '03';
                default: return '404';
            }
        } else {
            switch ($status) {
                case '00': return '10';
                case '01': return '20';
                case '02': return '30';
                default: return '404';
            }
        }
    }

    public function render_data_table(LengthAwarePaginator $getOrders): array
    {
        $keyTable = ['order_code', 'recipient_name', 'number_phone', 'status', 'expired_at'];
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
            'url' => $getOrders->path(),
        ];

        return $render;
    }
}
