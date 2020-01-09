<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Revenue extends Model
{
  use SoftDeletes;
  protected $guarded = ['id'];
  
  public function Booking()
  {
    return $this->belongsTo('App\Booking');
  }

  public function Report()
  {
    return $this->belongsTo('App\Report');
  }

  public function Product()
  {
    return $this->hasOne('App\Product','id','product_id');
  }
  public function DeptSales()
  {
    return $this->belongsTo('App\DeptSales');
  }
  public function User()
  {
    return $this->belongsTo('App\User');
  }
}
