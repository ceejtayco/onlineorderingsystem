<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = ['id'];
    public $primarykey = 'code';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function order() {
        return $this->hasMany('App\Order');
    }
}
