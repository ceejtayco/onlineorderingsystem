<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo('App\User');
    }
    public function coupon() {
        return $this->belongsTo('App\Coupon');
    }

    public function order_details() {
        return $this->hasMany('App\Order_Details');
    }
}
