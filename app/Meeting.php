<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'meeting_date',
        'meeting_time',
        'meeting_with',
        'assgin_to',
        'subject',
        'notification',
        'nature',
        'remark'
];
}
