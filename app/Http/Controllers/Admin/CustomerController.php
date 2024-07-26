<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RenderController;
use App\Http\Controllers\FunctionController;

const MAX_PAGE = 15;

class CustomerController extends Controller
{

   
    public function index()
    {
        $maxNumberPage = DB::table('users')->get() / MAX_PAGE;
        $users = DB::table('users')->select('name','id','email', 'role')->take(15)->get(); //Lấy giá trị account
        $table = FunctionController::table('customer'); //Setting table
        $render = [$table, $users, 'number' => 0, 'maxPage' => $maxNumberPage];
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
        $maxNumberPage = intdiv(count(DB::table('users')->get()), MAX_PAGE);
        $number = MAX_PAGE * $numberPage;
        $users = DB::table('users')->select('name','id','email', 'role')->skip($number)->take(MAX_PAGE)->get();
        $table = FunctionController::table('customer'); //Setting table
        $render = [$table, $users, 'number' => $numberPage, 'maxPage' => $maxNumberPage];
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
