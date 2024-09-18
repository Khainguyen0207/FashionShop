<?php

namespace App\Exports;

use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromArray;

class ProductsExportExample implements FromArray
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        // Lấy danh sách cột từ bảng 'users'
        $columns = Schema::getColumnListing('products');

        return [$columns];
    }
}
