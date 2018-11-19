<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyLocation extends Model
{
    public function company_segments()
    {
    	return $this->hasMany('App\CompanySegment','location','id');
    }

    public function job_projects()
    {
    	return $this->hasMany('App\JobProject','location','id');
    }

    public function g_journals()
    {
        return $this->hasMany('App\GJournal','location','name');
    }

    public function company_sales_taxes()
    {
        return $this->hasMany('App\CompanySalesTaxes','location','id');
    }

    public function company()
    {
        return $this->belongsTo('App\Company','company_id','id');
    }

    public function jurisdiction()
    {
        return $this->belongsTo('App\StateProvince','tax_jurisdiction','id');
    }

    public function address()
    {
        return $this->belongsToMany('App\Address','model_address','model_id','address_id')->wherePivot('model_type','App\CompanyLocation');
    }
}
