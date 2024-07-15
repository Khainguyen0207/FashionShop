<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class RenderController extends Controller
{

    private function error_render($line_num) {
        throw new Exception('Thiếu giá trị render tại line: ' . $line_num); 
    }

    public static function render($view, $data) {
        switch ($view) {
            case 'home':
                $home = ['number_customers' , 'number_products' , 'number_checking', 'total'];
                if (count($home) == count($data)) {
                    return array_combine($home, $data);
                } else {
                    return self::error_render(31);
                }
            case 'customer': 
                $customers = ['header', 'body'];
                if (count($customers) == count($data)) {
                    return array_combine($customers, $data);
                } else {
                    return self::error_render(31);
                }
            case 'customer': 
        }
    }
}
