<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Revenue extends Model
{
  use SoftDeletes;

  public function Booking()
  {
    return $this->belongsTo('App\Booking');
  }

  public function Report()
  {
    return $this->belongsTo('App\Report');
  }
}
