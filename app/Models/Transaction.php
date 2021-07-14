<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $table ='transactions';

    protected $guarded = ['_token'];

    public function owner(){
        return $this->belongsTo('App\Models\Owner','owners_id')->withTrashed();
    }

    public function apartment(){
        return $this->belongsTo('App\Models\Properties','properties_id');
    }

    public function customer(){
        return $this->belongsTo('App\Models\Customer','customers_id');
    }
}
