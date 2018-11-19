<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyChartOfAccount extends Model
{
    public function account_type()
    {
    	return $this->belongsTo('App\AccountType','type','id');
    }

    public function parent_company()
    {
        return $this->belongsTo('App\Company','company_id','id');
    }

    public function sign()
    {
    	return $this->belongsTo('App\Sign','normal_sign','id');
    }

    public function account_map()
    {
    	return $this->belongsTo('App\CompanyAccountMap','map_no','id');
    }

    public function account_group()
    {
    	return $this->belongsTo('App\AccountGroup','group','id');
    }

    public function account_class()
    {
    	return $this->belongsTo('App\AccountClass','class','id');
    }

    public function g_journals()
    {
        return $this->hasMany('App\GJournal','account','account_no');
    }
}
