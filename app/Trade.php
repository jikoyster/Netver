<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    public function company_vendors()
    {
    	return $this->hasMany('App\CompanyVendor','trade','id');
    }
}
