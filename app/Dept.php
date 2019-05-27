<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dept extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'org_id','name','address','avatar','type','deptDetails'
    ];

    public function Org()
    {
      $this->belongsTo('App\Org');
    }

    public function Purchase()
    {
      $this->hasMany('App\Purchase');
    }

    public function Booking()
    {
      $this->hasMany('App\Booking');
    }

    public function Product()
    {
      $this->hasMany('App\Product');
    }

    public function Report()
    {
      $this->hasMany('App\Report');
    }
}
