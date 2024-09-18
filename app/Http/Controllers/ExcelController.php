<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExportExample;
use Maatwebsite\Excel\Facades\Excel;

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
