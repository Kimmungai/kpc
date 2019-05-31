<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Revenue extends Model
{
  use SoftDeletes;
  
  public function Booking()
  {
    $this->belongsTo('App\Booking');
  }

  public function Report()
  {
    $this->belongsTo('App\Report');
  }
}
