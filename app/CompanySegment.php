<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanySegment extends Model
{
    public function company_location()
    {
    	return $this->belongsTo('App\CompanyLocation','location','id');
    }

    public function company()
    {
    	return $this->belongsTo('App\Company','company_id','id');
    }

    public function parent_map()
    {
    	return $this->belongsTo('App\CompanySegment','parent_id','id');
    }

    public function children()
    {
    	return $this->hasMany('App\CompanySegment','parent_id','id');
    }

    public function g_journals()
    {
        return $this->hasMany('App\GJournal','segment','name');
    }
}
