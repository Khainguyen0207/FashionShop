<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banking_online extends Model
{
    use HasFactory;
    protected $fillable = [
        'token',
        'transaction_code',
        'expired_at'
    ];

    protected function casts(): array
    {
        return [
            'expired_at' => 'datetime',
        ];
    }
}
