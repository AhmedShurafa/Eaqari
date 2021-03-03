<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $guarded=[];

    public function owner(){
        return $this->belongsTo('App\Models\Owner');
    }

    public function messages(){
        return $this->hasMany('App\Models\Message');
    }
}
