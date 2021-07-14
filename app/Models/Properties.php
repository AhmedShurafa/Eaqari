<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Properties extends Model
{
    use SoftDeletes;

    protected $table ="properties";

    protected $guarded=['_token'];

    public function owner(){
        return $this->belongsTo('App\Models\Owner','owners_id')->withTrashed();
    }

    public function Area(){
        return $this->belongsTo('App\Models\Area','areas_id');
    }

    public function Property(){
        return $this->belongsTo('App\Models\Property_type','property_types_id')->withTrashed();
    }

    public function messages(){
        return $this->hasMany('App\Models\Message');
    }

    public function transaction(){
        return $this->hasMany('App\Models\Transaction');
    }
}
