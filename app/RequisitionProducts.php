<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisitionProducts extends Model
{
  public function Requisition()
  {
    return $this->belongsTo('App\Requisition');
  }
}
