<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
	        protected $guarded = [];

            public function User()
		{
		  	return $this->hasMany('App\User');
		}
}
