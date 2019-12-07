<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliver extends Model
{

        protected $guarded = [];
        
        public $table = 'deliveries';

        public function DeliveriesItem()
        {
        	return $this->hasMany('App\DeliveriesItem' , 'delivery_id');
        }
}
