<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = false;

    public function users()
    {
    	return $this->belongsToMany('App\User')->withPivot('inactive')->withTimestamps();
    }

    public function owner()
    {
    	return $this->hasOne('App\CompanyOwner');
    }

    public function country_currency()
    {
        return $this->belongsTo('App\CountryCurrency','country','id');
    }

    public function registration_type()
    {
        return $this->belongsTo('App\RegistrationType','registration_type_id','id');
    }

    public function locations()
    {
        return $this->hasMany('App\CompanyLocation','company_id','id');
    }

    public function segments()
    {
        return $this->hasMany('App\CompanySegment','company_id','id');
    }

    public function job_projects()
    {
        return $this->hasMany('App\JobProject','company_id','id');
    }

    public function documents()
    {
        return $this->hasMany('App\CompanyDocument','company_key','company_key');
    }

    public function chart_of_accounts()
    {
        return $this->hasMany('App\CompanyChartOfAccount','company_id','id');
    }

    public function account_maps()
    {
        return $this->hasMany('App\CompanyAccountMap','company_id','id');
    }

    public function journals()
    {
        return $this->hasMany('App\CompanyJournal','company_id','id');
    }

    public function vendors()
    {
        return $this->hasMany('App\CompanyVendor','company_id','id');
    }

    public function terms()
    {
        return $this->hasMany('App\CompanyTerm','company_id','id');
    }

    public function g_journals()
    {
        return $this->hasMany('App\GJournal','company_key','company_key');
    }

    public function trades()
    {
        return $this->hasMany('App\Trade','company_id','id');
    }

    public function address()
    {
        return $this->belongsToMany('App\Address','model_address','model_id','address_id')->wherePivot('model_type','App\Company');
    }

    public function account_split_items()
    {
        return $this->hasMany('App\AccountSplitItem','company_id','id');
    }

    public function fiscal_periods()
    {
        return $this->hasMany('App\CompanyFiscalPeriod','company_key','company_key');
    }

    public function default_accounts()
    {
        return $this->hasMany('App\CompanyDefaultAccount','company_key','company_key');
    }
}
