<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function roles()
    {
    	return $this->belongsToMany('Spatie\Permission\Models\Role','model_has_roles','model_id','role_id');
    }

    public function users()
    {
    	return $this->belongsToMany('App\User')->withTimestamps();
    }

    /*public function menus()
    {
        return $this->belongsToMany('App\Menu')->withTimestamps();
    }*/

    public function menu_sets()
    {
        return $this->belongsToMany('App\MenuSet')->withTimestamps();
    }
}
