<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnquiryDataSource extends Model
{
    protected $fillable = [
        'EnquiryDataSource_Name',
        'is_active'

    ];
}
