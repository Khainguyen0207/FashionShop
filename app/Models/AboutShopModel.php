<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AboutShopModel extends Model
{
    use HasFactory;

    protected $table = 'about_shop';

    protected $fillable = [
        'key',
        'value'
    ];

    protected function casts(): array
    {
        return [
        ];
    }

}