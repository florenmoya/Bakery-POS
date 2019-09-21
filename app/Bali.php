<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bali extends Model
{
	
            protected $guarded = [];

        public function BaliItems()
        {
        	return $this->hasMany('App\BaliItems' , 'balis_id');
        }
}
