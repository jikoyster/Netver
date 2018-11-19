<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChartOfAccountGroup extends Model
{
    public function country()
    {
    	return $this->belongsTo('App\CountryCurrency','country_id','id');
    }

    public function map_group()
    {
    	return $this->belongsTo('App\MapGroup','map_group_id','id');
    }

    public function lists()
    {
    	return $this->hasMany('App\ChartOfAccountGroupList','coag_id','id');
    }
}
