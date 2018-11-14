<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function state_province()
    {
        return $this->belongsTo('App\StateProvince','state_province_name','id');
    }

    public function address_histories()
    {
    	return $this->hasMany('App\AddressHistory','address_id','id');
    }
}
