<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description', 'min_purchase'];

    public function user(){
        return $this->belongsToMany(User::class);
    }
}
