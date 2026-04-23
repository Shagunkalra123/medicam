<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferredBy extends Model
{
    protected $fillable = [
        'ReferredBy_Name',
        'is_active'

    ];
}
