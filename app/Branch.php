<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
    'Branch_Name',
    'Branch_Manager',
    'Company',
    'Contact_No',
    'GSTIN_UIN',
    'Country',
    'State',
    'City',
    'Contact_Address',
    'Area',
    'Landmark',
    'is_active'
   ];
}
