<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
        protected $guarded = [];

        public function RegistersActivity()
		{
		  return $this->belongsTo('App\RegistersActivity');
		}
		        public function SalesItem()
        {
        	return $this->hasMany('App\SalesItem');
        }
}
