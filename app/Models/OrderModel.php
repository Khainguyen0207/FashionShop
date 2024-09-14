<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = 'orders';
    
    protected $fillable = [
        'order_code',
        'recipient_name',
        'number_phone',
        'address',
        'order_information',
        'status',
        'expired_at'
    ];

    protected function casts(): array
    {
        return [
            'expired_at' => 'datetime',
        ];
    }
}