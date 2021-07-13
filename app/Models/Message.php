<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $table = 'messages';

    protected $guarded=[];

    public function owner(){
        return $this->belongsTo('App\Models\Owner','owners_id')->withTrashed();
    }

    public function apartment(){
        return $this->belongsTo('App\Models\Properties')->withTrashed();
    }

    public function customer(){
        return $this->belongsTo('App\Models\Customer');
    }
}
