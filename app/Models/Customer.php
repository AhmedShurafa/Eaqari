<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $guarded = ['_token'];

    protected $table = "customers";

    public function messages(){
        return $this->hasMany('App\Models\Message');
    }

    public function transaction(){
        return $this->hasMany('App\Models\Transaction');
    }
}
