<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeptServices extends Model
{
  protected $guarded = ['id'];
  
  public function Dept()
  {
    return $this->belongsTo('App\Dept');
  }
}
