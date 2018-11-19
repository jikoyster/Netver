<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyOwner extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }

    public function company()
    {
    	return $this->belongsTo('App\Company','company_id','id');
    }
}
