<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RenderController;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->select('id', 'name', 'email')->get();
        $products = DB::table('products')->select()->get();
        $totalOrders = OrderModel::query()->where('status', '00')->count();
        $data = [count($users), count($products), $totalOrders, 0];

        return view('admin.home', RenderController::render('home', $data));
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
