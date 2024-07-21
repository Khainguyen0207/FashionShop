<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionController;
use App\Http\Controllers\RenderController;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('users')->select('name','id','email', 'role')->take(15)->get(); //Lấy giá trị account
        $table = FunctionController::table('customer'); //Setting table
        $render = [$table, $users];
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
        $maxPage = 15;
        $number = $maxPage * $numberPage;
        $users = DB::table('users')->select('name','id','email', 'role')->skip($number)->take($maxPage)->get();
        $table = FunctionController::table('customer'); //Setting table
        $render = [$table, $users];
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
    public function destroy(string $id)
    {
        //
    }
}
