<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\client;

class IndiaMart extends Model
{
    public function org()
    {
       return $this->hasOne(client::class,'mobile_number','mobile');
   }
}
