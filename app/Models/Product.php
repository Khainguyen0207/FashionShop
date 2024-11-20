<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =
    [
        "product_name",
        "price",
        "unsold_quantity",
        "description",
        "image",
        "product_code",
        "unsold_quantity",
        "category_id",
        "sizes",
        "colors"
    ];
}
