<?php

namespace App\Http\Controllers;
use App\Http\Controllers;

class FunctionController extends Controller
{
    public static function table($name_table, $key) {
        $table_customers = ['Tên', 'Mã Khách Hàng', 'Email', 'Quyền'];
        $table_products = ['Tên sản phẩm', 'Mã sản phẩm', 'Giá', 'Danh mục', 'Số lượng tồn kho'];

        switch ($name_table) {
            case 'customer': return array_combine($key, $table_customers);
            case 'product': return array_combine($key, $table_products);
        }
        return null;
    }
}