<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;


class Owner extends Authenticatable
{
    use SoftDeletes;

    protected $guarded = ['_token'];

    protected $table = "owners";

    public function Properties(){
        return $this->hasMany('App\Models\Properties');
    }

    public function messages(){
        return $this->hasMany('App\Models\Message');
    }

    public function transaction()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
