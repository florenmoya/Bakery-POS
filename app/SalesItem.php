<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesItem extends Model
{
        protected $guarded = [];		
        
        public function Sales()
    {
        return $this->belongsTo('App\Sales');
    }
            public function Item()
    {
            return $this->belongsTo('App\Item');
    }
}
