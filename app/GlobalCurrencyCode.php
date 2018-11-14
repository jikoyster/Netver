<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalCurrencyCode extends Model
{
    public function company_vendors()
    {
    	return $this->hasMany('App\CompanyVendor','currency','id');
    }

    public function company_chart_of_accounts()
    {
    	return $this->hasMany('App\CompanyChartOfAccount','currency','id');
    }
}
