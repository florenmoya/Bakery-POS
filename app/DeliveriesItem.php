<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveriesItem extends Model
{
        protected $guarded = [];

        public function Deliver()
		{
		  return $this->belongsTo('App\Deliver');
		}
}
