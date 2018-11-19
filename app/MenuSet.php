<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuSet extends Model
{
    public function groups()
    {
        return $this->belongsToMany('App\Group')->withTimestamps();
    }

    public function menus()
    {
    	return $this->hasMany('App\Menu','menu_set_id','id');
    }
}
