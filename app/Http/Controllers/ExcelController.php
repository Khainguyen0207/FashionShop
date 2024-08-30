<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExportExample;

class ExcelController extends Controller
{
    /**
     * Export users data to Excel.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new ProductsExportExample, 'ProductsExportExample.xlsx'); //Xuất ví dụ nhập liệu
    }
}
