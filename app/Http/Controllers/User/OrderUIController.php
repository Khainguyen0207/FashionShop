<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
        dd($products->toArray());
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
