<?php

namespace App\Http\Controllers;
use App\Http\Controllers;

class FunctionController extends Controller
{
    public static function table($name_table) {
        $table_customers = ['Tên', 'Mã Khách Hàng', 'Email', 'Quyền'];
        $table_products = [''];

        switch ($name_table) {
            case 'customer': return $table_customers;
            case 'products': return $table_products;
        }

        return null;

    }
}
