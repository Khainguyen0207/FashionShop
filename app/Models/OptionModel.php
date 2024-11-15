<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionModel extends Model
{
    protected $table = "options";

    protected $fillable = [
        'id',
        'name',
        'option',
    ];
}
