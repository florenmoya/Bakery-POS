<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

        public function Item()
    {
            return $this->hasMany('App\Item');
    }

}
