<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainOrder extends Model
{
    protected $fillable = [
        'contact_person_name',
        'organization_name',
        'mobile_number',
        'email_id',
        'address',
        'subtotal',
        'tax_amount',
        'discount_amount',
        'grand_total',
        'is_active',
        'enqid_hidden',
        'entryLevelHidden',
        'proposalIDHidden'
    ];
}
