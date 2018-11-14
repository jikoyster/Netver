<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChartOfAccountGroupList extends Model
{
    public function account_type()
    {
    	return $this->belongsTo('App\AccountType','account_type_id','id');
    }

    public function sign()
    {
    	return $this->belongsTo('App\Sign','normal_sign','id');
    }

    public function account_map()
    {
    	return $this->belongsTo('App\AccountMap','account_map_no_id','id');
    }

    public function account_group()
    {
    	return $this->belongsTo('App\AccountGroup','account_group_id','id');
    }

    public function account_class()
    {
    	return $this->belongsTo('App\AccountClass','account_class_id','id');
    }

    public function national_chart_of_account_list()
    {
    	return $this->belongsTo('App\NationalChartOfAccountList','nca','id');
    }
}
