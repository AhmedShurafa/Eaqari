<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Owner extends Model
{
    use SoftDeletes;

    protected $fillable  = ['user_id','phone','phone2',
                            'ssn','evaluate','image',
                            'facebook','twitter','instagram',
                            'status'];

    public function user(){
        return $this->belongsTo('App\User')->withTrashed();
    }

    public function apartment(){
        return $this->hasMany('App\Models\Apartment');
    }

    public function messages(){
        return $this->hasMany('App\Models\Message');
    }
}
