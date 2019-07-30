<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistersWithdrawAmount extends Model
{
    protected $guarded = [];

            public function RegistersActivity()
		{
		  return $this->belongsTo('App\RegistersActivity');
		}
}
