<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EventModel extends Model
{
    protected $table = "events";

    protected $fillable = [
        'id',
        'title',
        'information',
        'image',
        'start_time',
        'end_time'
    ];
}