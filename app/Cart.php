<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'item_id', 'order_id', 'price', 'quantity', 'name'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
