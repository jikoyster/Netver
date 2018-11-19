<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStatusHistory extends Model
{
    public function scopeActivated($query, $status = 1)
    {
        return $query->where('activated',$status);
    }
}
