<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_otp extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'email',
        'code',
        'expired_at',
    ];

    protected function casts(): array
    {
        return [
            'expired_at' => 'datetime',
        ];
    }
}
