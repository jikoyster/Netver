<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryCurrency extends Model
{
	public $timestamps = false;

    protected $fillable = [
    	'country_name', 'currency_name', 'iso_code', 'currency_code', 'currency_symbol', 'inactive'
    ];

    public function state_provinces()
    {
    	return $this->hasMany('App\StateProvince','country_currency_id','id');
    }

    public function map_groups()
    {
    	return $this->hasMany('App\MapGroup','country_id','id');
    }
}
