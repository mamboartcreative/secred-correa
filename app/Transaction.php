<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'references', 'order_id', 'amount', 'status', 'remarks'
    ];
}
