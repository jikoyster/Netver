<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationType extends Model
{
    public function company_vendors()
    {
    	return $this->hasMany('App\CompanyVendor','registration_type','id');
    }

    public function companies()
    {
    	return $this->hasMany('App\Company','registration_type_id','id');
    }
}
