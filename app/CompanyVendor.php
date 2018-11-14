<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyVendor extends Model
{
    public function getFullNameAttribute()
	{
	    return "{$this->first_name} {$this->last_name}";
	}

	public function parent_company()
	{
		return $this->belongsTo('App\Company','company_id','id');
	}

	public function address()
	{
		return $this->belongsToMany('App\Address','model_address','model_id','address_id')->wherePivot('model_type','App\CompanyVendor');
	}

	public function _trade()
	{
		return $this->belongsTo('App\Trade','trade','id');
	}
}
