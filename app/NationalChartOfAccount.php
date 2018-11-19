<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NationalChartOfAccount extends Model
{
    public function country()
    {
    	return $this->belongsTo('App\CountryCurrency','country_id','id');
    }

    public function lists()
    {
    	return $this->hasMany('App\NationalChartOfAccountList','nca_id','id');
    }

    public function map_groups()
    {
    	return $this->hasMany('App\MapGroup','nca_id','id');
    }
}
