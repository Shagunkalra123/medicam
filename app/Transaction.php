<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'amount_recieved',
        'transaction_id',
        'payment_date',
        'payment_mode',
        'leave_note',
        'invoice_id'
    ];
}
