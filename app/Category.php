<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function item() {
        return $this->hasMany('App\Item');
    }
}
