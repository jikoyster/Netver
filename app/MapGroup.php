<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MapGroup extends Model
{
    public function country()
    {
    	return $this->belongsTo('App\CountryCurrency','country_id','id');
    }

    public function nca()
    {
    	return $this->belongsTo('App\NationalChartOfAccount','nca_id','id');
    }

    public function lists()
    {
    	return $this->hasMany('App\MapGroupList','map_group_id','id');
    }

    public function chart_of_account_groups()
    {
        return $this->hasMany('App\ChartOfAccountGroup','map_group_id','id');
    }
}
