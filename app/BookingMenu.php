<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingMenu extends Model
{
  public function Booking()
  {
    return $this->belongsTo('App\Booking');
  }
}
