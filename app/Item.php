<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Spatie\Activitylog\Traits\LogsActivity;

class Item extends Model
{
        // use LogsActivity;
        protected $guarded = [];
        protected static $logUnguarded = true;

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
}
