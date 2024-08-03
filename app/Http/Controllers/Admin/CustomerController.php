<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RenderController;
use App\Http\Controllers\FunctionController;

const MAX_PAGE = 15;

class CustomerController extends Controller
{
    public function index()
    {
        $url = route('admin.customer.index');
        $key = ['name','id','email', 'role'];
        $maxNumberPage = intdiv(count(DB::table('users')->get()), MAX_PAGE);
        $users = DB::table('users')->select($key)->take(15)->get(); //Lấy giá trị account
        $users = json_decode($users, true);

        foreach ($users as $index => $account) {
            if ($account['role'] == 1) {
                $users[$index]['role'] = 'admin';
            } else if ($account['role'] == 0) {
                $users[$index]['role'] = 'user';
            }
        }
        $table = FunctionController::table('customer',$key); //Setting table
        $render = [$table, $users, $key,  'number' => 0, 'maxPage' => $maxNumberPage, $url];
        return view('admin.customer', RenderController::render('customer', $render));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    public function page(string $numberPage)
    {
        $key = ['name','id','email', 'role'];
        $maxNumberPage = intdiv(count(DB::table('users')->get()), MAX_PAGE);
        $number = MAX_PAGE * $numberPage;
        $users = DB::table('users')->select($key)->skip($number)->take(MAX_PAGE)->get();
        $users = json_decode($users, true);
        $table = FunctionController::table('customer', $key); //Setting table theo key và sẽ xuất bảng theo key
        $url = route('admin.customer.index');
        $render = [$table, $users , $key, $numberPage, $maxNumberPage, $url];
        return view('admin.customer', RenderController::render('customer', $render));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $info = DB::table('users')->where('id', $id)->get();
        $deleted = DB::table('users')->where('id', $id)->delete();
        $date = Carbon::now();;
        if ($deleted) {
            fwrite(fopen('UpdateDataBase.txt', 'a'), "Delete account: $info \nIn table 'users' =>  Time $date\n");
        }
        return redirect($_SERVER['HTTP_REFERER']);
    }
}
