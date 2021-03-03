<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded=[];

    public function owner(){
        return $this->belongsTo('App\Models\Owner');
    }

    public function apartment(){
        return $this->belongsTo('App\Models\Apartment');
    }
}
