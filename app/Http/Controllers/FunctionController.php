<?php

namespace App\Http\Controllers;
use App\Http\Controllers;

class FunctionController extends Controller
{
    public static function table($name_table) {
        $table_customers = ['Tên', 'Mã Khách Hàng', 'Email', 'Quyền'];
        $table_products = ['Tên sản phẩm', 'Mã sản phẩm', 'Danh mục', 'Giá', 'Số lượng tồn kho', 'Trạng thái'];

        switch ($name_table) {
            case 'customer': return $table_customers;
            case 'product': return $table_products;
        }
        return null;
    }
}
