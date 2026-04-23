<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnquiryType extends Model
{
    protected $fillable = [
        'EnquiryType_Name',
        'is_active'

    ];

}
