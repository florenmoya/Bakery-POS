<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistersActivity extends Model
{
        protected $guarded = [];		

        public function sales()
        {
        	return $this->hasMany('App\Sales');
        }
        public function RegistersWithdrawAmount()
        {
        	return $this->hasMany('App\RegistersWithdrawAmount');
        }
}
