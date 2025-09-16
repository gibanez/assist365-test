<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'event',
        'data',
    ];

    protected $casts = [
        'data' => 'array', // para que se devuelva como array/JSON automáticamente
    ];
}
