<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewList extends Model
{
    protected $fillable = [
        'view_name',
        'view_code',
        'page_name',
        'user_id',
        'username'

    ];
}
