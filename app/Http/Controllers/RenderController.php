<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class RenderController extends Controller
{

    private static function error_render($line_num) {
        throw new Exception('Thiếu giá trị render tại line: ' . $line_num); 
    }

    public static function render($view, $data) {
        switch ($view) {
            case 'home':
                $home = [   
                    'number_customers', 
                    'number_products', 
                    'number_checking',
                    'total',
                ];

                if (count($home) == count($data)) {
                    return array_combine($home, $data);
                } else {
                    return self::error_render(22);
                }
            case 'customer':
                $customers = [
                    'header', 
                    'body', 
                    'number', 
                    'maxPage'
                ];//Set key = $customers
                if (count($customers) == count($data)) { //Kiểm tra số lượng key và value phải bắt buộc bằng nhau
                    return array_combine($customers, $data); 
                } else {
                    return self::error_render(29);
                }
            case 'product':
                $customers = ['header', 'body', 'name_category', 'id', 'number', 'maxPage']; //Set key = $products
                if (count($customers) == count($data)) { //Kiểm tra số lượng key và value phải bắt buộc bằng nhau
                    return array_combine($customers, $data); 
                } else {
                    return self::error_render(29);
                }
            case 'customer':
        }
    }
}
