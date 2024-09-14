<?php

namespace App\Http\Controllers;
use App\Http\Controllers;

class FunctionController extends Controller
{
    public static function table($name_table, $key) {
        $table_customers = ['Tên', 'Mã Khách Hàng', 'Email', 'Quyền'];
        $table_products = ['Tên sản phẩm', 'Mã sản phẩm', 'Giá', 'Danh mục', 'Số lượng tồn kho'];
        $table_ordercheck = ['Mã đơn hàng', 'Tên người nhận', 'Số điện thoại', 'Trạng thái', 'Thời gian'];
        switch ($name_table) {
            case 'customer': return array_combine($key, $table_customers);
            case 'product': return array_combine($key, $table_products);
            case 'ordercheck': return array_combine($key, $table_ordercheck);
            default: return null;
        }
    }

    public static function status_order($status) {
        //Mã thành công => 0
        //Mã lỗi từ người bán => 1
        //Mã lỗi từ người nhận => 2
        //Mã lỗi từ bên vận chuyển => 3
        //Mã lỗi từ bên vận chuyển => 4
        //Mã lỗi từ hệ thống => 5
        switch ($status) {
            case '00':
                return "Đang chờ xác nhận";
            case '01':
                return "Đang giao";
            case '03':
                return "Đã giao thành công";
            case '10':
                return "Đơn hàng bị hủy bởi người bán";
            case '20':
                return "Đơn hàng bị hủy bởi người nhận";
            case '30':
                return "Đơn hàng bị lỗi khi vận chuyển";
            default:
                return "Lỗi hệ thông";
        }
    }
}