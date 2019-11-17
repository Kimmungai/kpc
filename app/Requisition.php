<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
  public function RequisitionProducts()
  {
    return $this->hasMany('App\RequisitionProducts');
  }
}
