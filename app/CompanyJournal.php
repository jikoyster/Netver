<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyJournal extends Model
{
    public function journal()
    {
    	return $this->belongsTo('App\Journal','journalid','id');
    }
}
