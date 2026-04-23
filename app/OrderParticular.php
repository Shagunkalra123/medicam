<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderParticular extends Model
{
    protected $fillable = [
        'products',
        'qty',
        'price',
        'total',
        'order_id'
    ];
}
