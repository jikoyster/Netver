<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StateProvince extends Model
{
    public $timestamps = false;

    protected $fillable = [
    	'country_currency_id', 'state_province_name', 'inactive'
    ];

    public function  country()
    {
    	return $this->belongsTo('App\CountryCurrency','country_currency_id','id');
    }

    public function addresses()
    {
    	return $this->hasMany('App\Address','state_province_name','id');
    }
}
