<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobProject extends Model
{
    public function job_project_parent()
    {
    	return $this->belongsTo('App\JobProject','parent','id');
    }

    public function company_location()
    {
    	return $this->belongsTo('App\CompanyLocation','location','id');
    }

    public function job_project_child()
    {
    	return $this->hasMany('App\JobProject','parent','id');
    }

    public function jp_parent()
    {
        return $this->belongsTo('App\JobProject','parent','id');
    }

    public function job_project_status_histories()
    {
        return $this->hasMany('App\JobProjectStatusHistory','jp_id','id');
    }

    public function g_journals()
    {
        return $this->hasMany('App\GJournal','job_project','name');
    }
}
