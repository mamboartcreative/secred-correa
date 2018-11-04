<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name', 'description', 'cost_price', 'selling_price', 'quantity', 'picture', 'type'
    ];
}
