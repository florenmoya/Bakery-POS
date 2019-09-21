<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaliItems extends Model
{
        protected $guarded = [];

                public function Bali()
		{
		  	return $this->belongsTo('App\Bali');
		}
				public function Item()
	    {
	     	return $this->belongsTo('App\Item');
	    }

}
