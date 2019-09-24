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
    public function Category()
    {
            return $this->belongsTo('App\Category');
    }
                public function BaliItems()
    {
            return $this->hasMany('App\BaliItems');
    }
}
