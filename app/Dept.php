<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dept extends Model
{
  use SoftDeletes;
  
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
