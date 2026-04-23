<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'orderID',
        'organizationID',
        'enquiryID',
        'propasalID',
        'enquiryLevel',
        'paymentStatus',
        'subtotal',
        'tax_amount',
        'discount_amount',
        'grand_total',
        'amount_paid',
        'balance'
    ];
}
