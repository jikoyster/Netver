<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
	protected $dates = ['start_date','end_date'];
    public function state_province()
    {
    	return $this->belongsTo('App\StateProvince','province_state','id');
    }

    public function grouped_tax_rates()
    {
    	return $this->hasMany('App\GroupedTaxRate','parent_id','id');
    }
}
