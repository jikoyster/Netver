<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanySalesTax extends Model
{
	protected $dates = ['start_date','end_date'];
    public function state_province()
    {
    	return $this->belongsTo('App\StateProvince','province_state','id');
    }

    public function grouped_tax_rates()
    {
    	return $this->hasMany('App\GroupedCompanySalesTax','parent_id','id');
    }

    public function company_chart_of_accounts()
    {
    	return $this->hasMany('App\CompanyChartOfAccount','tax_account','id');
    }

    public function company_location()
    {
        return $this->belongsTo('App\CompanyLocation','location','id');
    }
}
