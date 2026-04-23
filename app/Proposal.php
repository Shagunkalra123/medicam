<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'subject', 
        'related', 
        'to', 
        'organization_name',
        'address', 
        'status', 
        'assigned',       
        'date', 
        'open_till',         
        'currency', 
        'discount_type', 
        'city', 
        'state',
        'country', 
        'zipcode', 
        'email', 
        'phone', 
        'product',
        'qty',
        'price',
        'total',
        'sub_total',
        'discount',
        'discount_amount',
        'tax_cgst',
        'tax_sgst',
        'Fr_charges',
        'tax_igst',
        'tax_amount',
        'total_amount',        
        'path',
        'entryLevelHidden',
        'enqid_hidden'
        
    ];

    public function getPropProducts(){
        $this->belongsToMany('App\prop_product','proposal_id','proposals.id');
    }
}
