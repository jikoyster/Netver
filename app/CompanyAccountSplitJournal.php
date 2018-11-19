<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyAccountSplitJournal extends Model
{
    public function account_split_item()
    {
    	return $this->belongsTo('App\AccountSplitItem','sub_account_no','id');
    }

    public function segment()
    {
    	return $this->belongsTo('App\CompanySegment','sub_account_no','id');
    }

    public function job_project()
    {
    	return $this->belongsTo('App\JobProject','sub_account_no','id');
    }
}
