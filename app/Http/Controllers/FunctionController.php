<?php

namespace App\Http\Controllers;

class FunctionController extends Controller
{
    public static function table($name_table, $key)
    {
        $table_customers = ['Tên', 'Mã Khách Hàng', 'Email', 'Quyền'];
        $table_products = ['Tên sản phẩm', 'Mã sản phẩm', 'Giá', 'Danh mục', 'Số lượng tồn kho'];
        $table_order = ['Mã đơn hàng', 'Tên người nhận', 'Số điện thoại', 'Trạng thái', 'Thời gian'];
        $event = ['ID sự kiện', 'Tiêu đề', 'Bắt đầu', 'Kết thúc'];
        switch ($name_table) {
            case 'customer': return array_combine($key, $table_customers);
            case 'product': return array_combine($key, $table_products);
            case 'order': return array_combine($key, $table_order);
            case 'event': return array_combine($key, $event);
            default: return null;
        }
    }

    public static function status_order($status)
    {
        switch ($status) {
            case '00':
                return 'Đang chờ xác nhận';
            case '01':
                return 'Đang giao';
            case '02':
                return 'Đã giao thành công';
            case '10':
                return 'Bị hủy bởi người bán';
            case '20':
                return 'Bị hủy bởi người mua';
            case '30':
                return 'Bị lỗi khi vận chuyển';
            default:
                return 'Lỗi hệ thống';
        }
        //Mã thành công => 0
        //Mã lỗi từ người bán => 1
        //Mã lỗi từ người nhận => 2
        //Mã lỗi từ bên vận chuyển => 3
        //Mã lỗi từ bên vận chuyển => 4
        //Mã lỗi từ hệ thống => 5
    }
}
