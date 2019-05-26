<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function Dept()
    {
      $this->belongsTo('App\Dept');
    }

    public function Purchase()
    {
      $this->belongsToMany('App\Purchase');
    }

    public function Booking()
    {
      $this->belongsToMany('App\Booking');
    }

    public function Report()
    {
      $this->belongsToMany('App\Report');
    }
}
