<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessControlLevel extends Model
{
    public function features()
    {
    	return $this->belongsToMany('App\Feature')->withTimestamps();
    }

    public function permissions()
    {
    	return $this->belongsToMany('Spatie\Permission\Models\Permission','model_has_permissions','model_id','permission_id')->wherePivot('model_type','App\AccessControlLevel');
    }

    public function role()
    {
    	return $this->belongsTo('Spatie\Permission\Models\Role');
    }
}
