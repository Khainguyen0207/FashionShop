<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionController;
use App\Http\Controllers\RenderController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

const MAX_PAGE = 15;

class CustomerController extends Controller
{
    public function index()
    {
        $render = $this->getCustomers();

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
    public function show(string $id) {}

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
        $date = Carbon::now();
        if ($deleted) {
            fwrite(fopen('UpdateDataBase.txt', 'a'), "Delete account: $info \nIn table 'users' =>  Time $date\n");
        }

        return redirect($_SERVER['HTTP_REFERER']);
    }

    private function getCustomers()
    {
        $getCustomers = DB::table('users')->paginate(15);
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
            'maxNumberPage' => $getCustomers->lastPage(),
            'url' => $getCustomers->path(),
        ];

        return $render;
    }
}
