<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
        protected $guarded = [];

        public function SalesItem()
    {
            return $this->hasMany('App\SalesItem');
    }
        public function DeliveriesItem()
    {
            return $this->hasMany('App\DeliveriesItem');
    }
        public function Categories()
    {
            return $this->belongsTo('App\Categories', 'category_id');
    }
        public function BaliItems()
    {
            return $this->hasMany('App\BaliItems');
    }
}
