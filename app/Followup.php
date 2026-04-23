<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    protected $fillable = [
        'rem_date',
        'rem_time',
        'subject',
        'note',
        'nature'
];
}
