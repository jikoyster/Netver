<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UIReport extends Model
{
    protected $table = 'ui_reports';
    protected $dates = ['resolved_at'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function resolver()
    {
    	return $this->belongsTo('App\User','resolved_by','id');
    }
}
