<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dept extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'org_id','name','address','avatar','type','deptDetails','targetCosts','targetRevenues','staffCapacity','bookingCapacity','stockCapacity'
    ];

    public function Org()
    {
      $this->belongsTo('App\Org');
    }

    public function Purchase()
    {
      return  $this->hasMany('App\Purchase');
    }

    public function Booking()
    {
     return  $this->hasMany('App\Booking');
    }

    public function Product()
    {
      return $this->hasMany('App\Product');
    }

    public function Report()
    {
      return $this->hasMany('App\Report');
    }

    public function Requisition()
    {
      return $this->hasMany('App\Requisition');
    }
    public function DeptRooms()
    {
      return $this->hasMany('App\DeptRooms');
    }
    public function DeptServices()
    {
      return $this->hasMany('App\DeptServices');
    }
}
