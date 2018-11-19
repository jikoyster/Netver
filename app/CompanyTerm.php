<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyTerm extends Model
{
    public function company_vendors()
    {
    	return $this->hasMany('App\CompanyVendor','term','id');
    }
}
