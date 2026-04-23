<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
            'emp_id',
            'first_name',
            'last_name',
            'emp_username',
            'password',
            'emp_email',
            'emp_contact',
            'gender',
            'Marital_status',
            'dob',
            'designation',
            'address',
            'blood_group',
            'relative_name',
            'relation',
            'relative_contact',
            'relative_address',
            'employee_photo',
            'is_active'
    ];
}
