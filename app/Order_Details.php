<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Details extends Model
{
    protected $guarded = ['id'];

    public function order() {
        return $this->belongsTo('App\Order');
    }

    public function item() {
        return $this->belongsTo('App\Item');
    }
}
