<?php

namespace App\Http\Controllers;

use Imagick;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

class FunctionController extends Controller
{
    public static function table($name_table, $key)
    {
        $table_customers = ['ID','Tên khách hàng',  'Email', 'Quyền'];
        $table_products = ['Tên sản phẩm', 'Mã sản phẩm', 'Giá', 'Danh mục', 'Số lượng'];
        $table_order = ['Mã đơn hàng', 'Tên người nhận', 'Số điện thoại', 'Trạng thái', 'Thời gian'];
        $event = ['ID', 'Hình ảnh',  'Tiêu đề', 'Bắt đầu', 'Kết thúc', 'Trạng thái'];
        switch ($name_table) {
            case 'customer': return array_combine($key, $table_customers);
            case 'product': return array_combine($key, $table_products);
            case 'order': return array_combine($key, $table_order);
            case 'event': return array_combine($key, $event);
            default: return null;
        }
    }

    public static function button(array $buttons)
    {
        $button = [
            'info' => 'fa-solid fa-info', 
            'edit' => 'fa-solid fa-edit', 
            'cancel' => 'fa-solid fa-xmark',
            'check' => 'fa-solid fa-check',
            'del' => 'fa-solid fa-trash-can',
        ];
        
        $btn_select = array_intersect_key($button, array_flip($buttons));
        
        return $btn_select;
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

    public static function cutImage($path) {
        File::copy(url($path), "logo_32.png");
        // Tải ảnh từ đường dẫn
        $image = Image::read("logo_32.png");
        // Cắt ảnh
        $image->resize(32, 32);
        // Lưu ảnh sau khi cắt
        $image->save("logo_32.png");
        return $image;
    }
}
