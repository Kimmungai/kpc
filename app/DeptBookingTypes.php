<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeptBookingTypes extends Model
{
  protected $guarded = ['id'];

  public function Dept()
  {
    return $this->belongsTo('App\Dept');
  }
  
}
