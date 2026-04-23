<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $fillable = [
        'contact_person_name',
        'contact_person_name_acc',
        'organization_name',
        'fax',
        'gst',
        'industry',
        'landmark',
        'city_town',
        'postal_code',
        'mobile_number',
        'primary_phone',
        'primary_email',
        'unique_id',
        'data_source',
        'address',
        'select_branch',
        'organization_type',
        'email_id',
        'secondary_phone',
        'secondary_email',
        'telecaller',
        'zone',
        'country',
        'pan_no',
        'Assign_To',
        'website',
        'sales_person',
        'area',
        'state',
        'description',
        'association_with_medicam',
        'Priority',
        'subpriority',
        'is_active'
    ];
}
