<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class enquiry_products extends Model
{
    protected $fillable = ['Product','Unit','Assign_To','Requested_Quantity','Co_ordinated_with','enquiry_id'];
}
