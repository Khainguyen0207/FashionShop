<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionController;
use App\Http\Controllers\RenderController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CustomerController extends Controller
{
    public function index()
    {
        $search = request()->query();
        $getCustomers = User::where(function ($query) use ($search) {
            foreach ($search as $key => $value) {
                if (Schema::hasColumn('users', $key)) {
                    $query->orWhere($key, 'LIKE', '%'.$value.'%');
                }
            }
        })->paginate(15);
        if ($getCustomers->currentPage() > $getCustomers->lastPage()) {
            abort(404);
        }
        $render = $this->getCustomers($getCustomers);

        return view('admin.customer', RenderController::render('customer', $render));
    }

    public function show(Request $request)
    {
        $keywords = $request->query();
        unset($keywords['_token']);
        $users = User::where(function ($query) use ($keywords) {
            foreach ($keywords as $key => $value) {
                if (Schema::hasColumn('users', $key)) {
                    $query->orWhere($key, 'LIKE', '%'.$value.'%');
                }
            }
        })->paginate(15);
        $render = $this->getCustomers($users);

        return view('admin.customer', RenderController::render('customer', $render));
    }

    public function destroy($id)
    {
        $info = DB::table('users')->where('id', $id)->get();
        $deleted = DB::table('users')->where('id', $id)->delete();
        $date = Carbon::now();
        if ($deleted) {
            fwrite(fopen('UpdateDataBase.txt', 'a'), "Delete account: $info \nIn table 'users' =>  Time $date\n");
        }

        return redirect($_SERVER['HTTP_REFERER']);
    }

    private function getCustomers($getCustomers)
    {
        $keyTable = ['id', 'name' , 'email', 'role'];
        $table = FunctionController::table('customer', $keyTable); //Setting table
        $users = $getCustomers->items();
        foreach ($users as $key => $item) {
            $users[$key] = collect($users[$key])->toArray();
            if ($users[$key]['role'] == 1) {
                $users[$key]['role'] = 'Quản trị viên';
            } elseif ($users[$key]['role'] == 0) {
                $users[$key]['role'] = 'Người dùng';
            } elseif ($users[$key]['role'] == 2) {
                $users[$key]['role'] = 'Quyền quản trị viên';
            } else {
                $users[$key]['role'] = 'Tài khoản bị khóa';
            }
        }
        $render = [
            $table,
            $users,
            $keyTable,
            'number' => $getCustomers->currentPage(),
            'maxPage' => $getCustomers->lastPage(),
            'url' => $getCustomers->path(),
        ];

        return $render;
    }
}
