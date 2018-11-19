<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountSplitItem extends Model
{
    public function company_chart_of_account()
    {
    	return $this->belongsTo('App\CompanyChartOfAccount','account_no','id');
    }
}
