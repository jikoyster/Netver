<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GJournal extends Model
{
    protected $dates = ['date'];

    public function company()
    {
    	return $this->belongsTo('App\Company','company_key','company_key');
    }

    public function _user()
    {
    	return $this->belongsTo('App\User','user','id');
    }

    public function _job_project()
    {
    	return $this->belongsTo('App\JobProject','job_project','name');
    }

    public function _segment()
    {
    	return $this->belongsTo('App\CompanySegment','segment','name');
    }

    public function parent()
    {
    	return $this->belongsTo('App\GJournal','t_l_no','trans_line_no');
    }

    public function scopeChild($query, $transaction_no, $trans_line_no)
    {
        return $query->where('transaction_no',$transaction_no)->where('t_l_no',$trans_line_no);
        //return $this->hasMany('App\GJournal','t_l_no','trans_line_no');
    }

    public function sibling()
    {
        return $this->hasMany('App\GJournal','t_l_no','t_l_no');
    }

    public function company_account_split()
    {
        return $this->hasMany('App\CompanyAccountSplitJournal','t_no','transaction_no');
    }
}
