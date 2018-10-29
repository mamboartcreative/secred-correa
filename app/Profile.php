<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'ic', 'hp', 'address', 'city', 'postcode', 'state', 'picture', 'references',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
