<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyFiscalPeriod extends Model
{
    protected $dates = ['start_date','end_date'];

    public function fiscal_periods_controls()
    {
    	return $this->hasMany('App\CompanyFiscalPeriodsControl','company_fiscal_period_id','id');
    }
}
