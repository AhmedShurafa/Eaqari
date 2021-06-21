<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property_type extends Model
{
    use SoftDeletes;

    protected $table ="property_type";

    public function apartment(){
        return $this->hasMany('App\Models\Apartment');
    }
}
