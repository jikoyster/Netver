<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\EmailConfirmation;

use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use App\TableColumnDescription;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasApiTokens;

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'system_user_id', 'designation_id', 'first_name', 'last_name', 'email', 'password', 'home_phone', 'mobile_phone'
    ];
    protected $dates = ['activated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendEmailConfirmationNotification($token, $type = null)
    {
        $this->notify(new EmailConfirmation($token, $this->email, false, $type));
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new EmailConfirmation($token, $this->email,true));
    }

    public function address()
    {
        return $this->belongsToMany('App\Address','model_address','model_id','address_id')->wherePivot('model_type','App\User');
    }

    /*
     **************************************
     * this is for companies relationship *
     **************************************
     */

    /* old */

    public function businesses()
    {
        return $this->hasMany('App\Company','user_id','id');
    }

    /* new */

    public function companies()
    {
        return $this->belongsToMany('App\Company')->withTimestamps();
    }

    public function owned_companies()
    {
        return $this->hasMany('App\CompanyOwner','user_id','id');
    }

    /*
     ******************************
     * end companies relationship *
     ******************************
     */

    public function groups()
    {
        return $this->belongsToMany('App\Group')->withTimestamps();
    }

    public function audit_trails()
    {
        return $this->hasMany('App\AuditTrail','user_id','id');
    }

    public function store_activity($activity)
    {
        $audit_trail = new \App\AuditTrail(['activity' => $activity,'created_at' => now()]);
        $this->audit_trails()->save($audit_trail);
    }

    public function invited_users()
    {
        return $this->hasMany('App\User','parent_id','id');
    }

    public function access_control_level()
    {
        return $this->hasMany('App\AccessControlLevel','creator_id','id');
    }

    public function ui_reports()
    {
        return $this->hasMany('App\UIReport','user_id','id');
    }

    public function ui_reports_solved()
    {
        return $this->hasMany('App\UIReport','resolved_by','id');
    }

    public function user_status_histories()
    {
        return $this->hasMany('App\UserStatusHistory','user_id','id');
    }

    public function company_fiscal_periods()
    {
        return $this->hasMany('App\CompanyFIscalPeriod','user_id','id');
    }

    public function designation()
    {
        return $this->belongsTo('App\Designation','designation_id','id');
    }

    public function table_column_description($table_name, $column_name)
    {
        $tcd = TableColumnDescription::where('table_name',$table_name)->where('table_column',$column_name);

        return $tcd->count() ? $tcd->first()->table_column_description : [];
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
