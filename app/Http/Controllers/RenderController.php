<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use Exception;

class RenderController extends Controller
{
    private static function error_render($line_num)
    {
        throw new Exception('Thiếu giá trị function: '.$line_num);
    }

    public static function render($view, $data)
    {
        $render_data = self::render_data_table($view);
        if (count($render_data) <= count($data)) { //Kiểm tra số lượng key và value phải bắt buộc bằng nhau
            return self::dataExceptionRender($render_data, $data);
        } else {
            return self::error_render(15 .'|'.$view);
        }
    }
    private static function render_data_table(string $template)
    {
        switch ($template) {
            case 'home':
                $home = ['number_customers', 'number_products', 'number_checking', 'total'];
                return $home;
            case 'customer':
                $customers = ['header', 'body', 'key', 'number', 'maxPage', 'url'];

                return $customers;
            case 'product':
                $products = ['header', 'body', 'key',  'name_category', 'id', 'number', 'maxPage', 'url', "options"];

                return $products;
            case 'order':
                $ordercheck = ['header', 'body', 'key', 'number', 'maxPage', 'url', 'icon', 'custom_button'];

                return $ordercheck;
            case 'settup':
                $settup = ['logo', 'banner', 'social_network', 'contact', 'option_samples'];
                return $settup;
            case 'event':
                $events = ['header', 'body', 'key', 'number', 'maxPage', 'url', 'icon', 'custom_button'];
                return $events;
            default: self::error_render('Lỗi hệ thống - 68');
        }
    }

    public static function dataExceptionRender($render_data, $data) //Xử lí thêm data ngoại lệ
    {
        //Render data: Khóa key cho template, Data là value của template
        $quantity = OrderModel::query()->get();
        $quantity_order_confirmation = $quantity->where('status', '00')->count();
        $number_of_order_in_transit = $quantity->where('status', '01')->count();
        $render_data['quantity'] = 'quantity';
        $data['quantity'] = [
            'sum' => $quantity_order_confirmation + $number_of_order_in_transit,
            'quantity_order_confirmation' => $quantity_order_confirmation,
            'number_of_order_in_transit' => $number_of_order_in_transit,
        ];
        // dd($render_data, $data);
        return array_combine($render_data, $data);
    }
}
