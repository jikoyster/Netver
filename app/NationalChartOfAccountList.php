<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NationalChartOfAccountList extends Model
{
    public function acc_type()
    {
    	return $this->belongsTo('App\AccountType','account_type','id');
    }

    public function nca()
    {
    	return $this->belongsTo('App\NationalChartOfAccount','nca_id','id');
    }
}
