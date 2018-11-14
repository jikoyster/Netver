<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
	protected $dates = ['created_at'];
    protected $table = 'audit_trail';
    public $timestamps = false;
    protected $fillable = ['activity','created_at'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
