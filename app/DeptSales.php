<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeptSales extends Model
{
  protected $guarded = ['id'];
  
  public function Dept()
  {
    return $this->belongsTo('App\Dept');
  }

  public function Revenue()
  {
    return $this->hasMany('App\Revenue');
  }
}
