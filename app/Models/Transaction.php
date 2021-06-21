<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $table ='transaction';

    protected $guarded = ['_token'];

    public function owners(){
        return $this->belongsTo('App\Models\Owners')->withTrashed();
    }

    public function Properties(){
        return $this->belongsTo('App\Models\Properties');
    }

    public function customer(){
        return $this->belongsTo('App\Models\Customers');
    }
}
