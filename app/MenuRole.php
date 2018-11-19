<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuRole extends Model
{
     protected $table = 'model_has_roles';

     public $timestamps = false;

     public function role()
     {
     	return $this->belongsTo('Spatie\Permission\Models\Role','role_id','id');
     }

     public function scopeMenuRoles($query)
     {
     	return $query->where('model_type','App\Menu');
     }
}
