<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistersActivities extends Model
{
        protected $guarded = [];		

        public function Sales()
        {
        	return $this->hasMany('App\Sales',);
        }
        public function Refunds()
        {
        	return $this->hasMany('App\Refunds');
        }
}
