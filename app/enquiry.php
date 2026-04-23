<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\client;

class enquiry extends Model
{
    protected $fillable =
     [
    'organisation_id',
    'Select_Contact_person',
    'organization_name',    
    'EnquiryDataSource_Name',
    'ReferredBy_Name',
    'EnquiryType_Name',
    'nature',
    'Expected_closed_Date',
    'Description_Note',
    
];

 public function org()
 {
    return $this->hasOne(client::class,'id','organisation_id');
}
}
