<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'firstName','org_id','lastName','middleName','phoneNumber','name', 'email', 'password','address','avatar','idNo','idImage','passport','passportImage','gender','DOB','type','dept',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Booking()
    {
      return $this->hasMany('App\Booking');
    }

    public function Purchase()
    {
      return $this->hasMany('App\Purchase');
    }

    public function Org()
    {
      return $this->belongsTo('App\Org');
    }

    public function Dept()
    {
      return $this->belongsTo('App\Dept','dept');
    }

    public function Requisition()
    {
      return $this->hasMany('App\Requisition', 'request_by');
    }
}
