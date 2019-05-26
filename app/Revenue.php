<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
  public function Booking()
  {
    $this->belongsTo('App\Booking');
  }

  public function Report()
  {
    $this->belongsTo('App\Report');
  }
}
