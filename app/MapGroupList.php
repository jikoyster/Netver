<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MapGroupList extends Model
{
    public function parent_map()
    {
        return $this->belongsTo('App\AccountMap','parent_id','id');
    }
    
    public function normal_sign()
    {
    	return $this->belongsTo('App\Sign','sign','id');
    }

    public function account_map()
    {
    	return $this->belongsTo('App\AccountMap','map_no','id');
    }

    public function account_group()
    {
        return $this->belongsTo('App\AccountGroup','group','id');
    }

    public function account_class()
    {
        return $this->belongsTo('App\AccountClass','class','id');
    }

    public function national_chart_of_account_list()
    {
    	return $this->belongsTo('App\NationalChartOfAccountList','nca','id');
    }

    public function flip_to_map()
    {
    	return $this->belongsTo('App\AccountMap','flip_to','id');
    }

    public function account_type()
    {
    	return $this->belongsTo('App\AccountType','type','id');
    }
}
