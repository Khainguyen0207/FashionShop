<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class RenderController extends Controller
{

    private static function error_render($line_num) {
        throw new Exception('Thiếu giá trị function: ' . $line_num); 
    }

    public static function render($view, $data) {
        $render_data = self::render_data_table($view);
        switch ($view) {
            case 'home':
                if (count($render_data) == count($data)) { //Kiểm tra số lượng key và value phải bắt buộc bằng nhau
                    return array_combine($render_data, $data);
                } else {
                    return self::error_render(15 ."|" .$view);
                }
            case 'customer':
                if (count($render_data) == count($data)) { //Kiểm tra số lượng key và value phải bắt buộc bằng nhau
                    return array_combine($render_data, $data); 
                } else {
                    return self::error_render(15 ."|" .$view);
                }
            case 'product':
                if (count($render_data) == count($data)) { //Kiểm tra số lượng key và value phải bắt buộc bằng nhau
                    return array_combine($render_data, $data);
                } else {
                    return self::error_render(15 ."|" .$view);
                }
            case 'ordercheck':
                if (count($render_data) == count($data)) { //Kiểm tra số lượng key và value phải bắt buộc bằng nhau
                    return array_combine($render_data, $data);
                } else {
                    return self::error_render(15 ."|" .$view);
                }
        }
    }

    private static function render_data_table(string $template) {
        switch ($template) {
            case 'home':
                $home = ['number_customers', 'number_products', 'number_checking', 'total']; return $home;
            case 'customer':
                $customers = ['header', 'body', 'key', 'number', 'maxPage', 'url']; return $customers;
            case 'product':
                $products = ['header', 'body', 'key',  'name_category', 'id', 'number', 'maxPage', 'url']; return $products;
            case 'ordercheck':
                $ordercheck = ['header', 'body', 'key', 'number', 'maxPage', 'url', 'icon']; return $ordercheck;
            default: self::error_render("Lỗi hệ thống - 59");
        }
    }
}
