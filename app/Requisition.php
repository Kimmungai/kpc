<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
  protected $guarded = ['id'];
  
  public function RequisitionProducts()
  {
    return $this->hasMany('App\RequisitionProducts');
  }
}
