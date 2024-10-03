<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use App\Http\Controllers\RenderController;
use App\Http\Controllers\FunctionController;

const MAX_PAGE = 15;

class CustomerController extends Controller
{
    public function index()
    {
        $getCustomers = User::paginate(15);
        if ($getCustomers->currentPage() > $getCustomers->lastPage()) {
            abort(404);
        }
        $render = $this->getCustomers($getCustomers);
        return view('admin.customer', RenderController::render('customer', $render));
    }

    public function show(Request $request) {
        $keywords = $request->query();
        $users = User::where(function($query) use ($keywords) {
            foreach ($keywords as $key => $value) {
                if ($key == "_token") {
                    continue;
                }
                $query->orWhere($key, 'LIKE', '%' . $value . '%');
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
        $keyTable = ['name', 'id', 'email', 'role'];
        $table = FunctionController::table('customer', $keyTable); //Setting table
        $users = $getCustomers->items();
        foreach ($users as $key => $item) {
            $users[$key] = collect($users[$key])->toArray();
            if ($users[$key]['role'] == 1) {
                $users[$key]['role'] = 'admin';
            } elseif ($users[$key]['role'] == 0) {
                $users[$key]['role'] = 'user';
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
