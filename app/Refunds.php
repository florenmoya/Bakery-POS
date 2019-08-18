<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refunds extends Model
{
        protected $guarded = [];

        public function RefundsItem()
        {
        	return $this->hasMany('App\RefundsItem');
        }
       	public function RegistersActivity()
		{
		  return $this->belongsTo('App\RegistersActivity');
		}
}
