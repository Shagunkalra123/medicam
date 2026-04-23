<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prop_product extends Model
{
    protected $fillable=['particulars', 'qty', 'price', 'total','proposal_id'];

    public function getProposals(){
        $this->hasOne('App\Proposal','id','proposal_id');
    }
}
