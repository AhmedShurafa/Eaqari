<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use SoftDeletes;

    protected $guarded=[];

    public function owner(){
        return $this->belongsTo('App\Models\Owner')->withTrashed();
    }

    public function messages(){
        return $this->hasMany('App\Models\Message');
    }
}
