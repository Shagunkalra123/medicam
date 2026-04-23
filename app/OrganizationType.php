<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganizationType extends Model
{
    protected $fillable = [
        'OrganizationType_Name',
        'is_active'

    ];
}
