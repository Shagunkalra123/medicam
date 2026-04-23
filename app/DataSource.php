<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataSource extends Model
{
    protected $fillable = [
        'DataSource_Name',
        'is_active'

    ];
}
