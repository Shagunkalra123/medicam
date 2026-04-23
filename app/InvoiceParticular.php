<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceParticular extends Model
{
    protected $fillable =[
        'Product',
        'qty',
        'price',
        'product_total',
        'Co_ordinated_with',
        'invoiceID'
    ];
}
