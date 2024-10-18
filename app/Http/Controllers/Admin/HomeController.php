<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RenderController;
use App\Models\OrderModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $orders = OrderModel::query();
        $users = DB::table('users')->select('id', 'name', 'email')->get();
        $products = DB::table('products')->select()->get();
        $totalOrders = $orders->where('status', '00')->count();
        $total_price = OrderModel::query()->where('status', '02')->whereMonth('expired_at', Carbon::now()->month)->get()->toArray();
        $data = [count($users), count($products), $totalOrders, $this->sum_price_month_current($total_price)];

        return view('admin.home', RenderController::render('home', $data));
    }

    private function sum_price_month_current($total_price)
    {
        $sum = 0;
        foreach ($total_price as $key => $value) {
            $order = json_decode($value['order_information'], true);

            foreach ($order as $key => $value) {
                $sum += $order[$key]['quantity'] * $order[$key]['price_product'];
            }
        }

        return $sum;
    }

    public function customer($name)
    {
        dd($name);
    }

    public function store(Request $request)
    {
        dd($request);
    }

    public function show($id) {}

    public function destroy()
    {
        Auth::logout();

        return redirect('auth');
    }
}
