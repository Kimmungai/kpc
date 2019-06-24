<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public function Dept()
    {
      return $this->belongsTo('App\Dept');
    }

    public function Purchase()
    {
      return $this->belongsToMany('App\Purchase');
    }

    public function Booking()
    {
      return $this->belongsToMany('App\Booking');
    }

    public function Report()
    {
      return $this->belongsToMany('App\Report');
    }
}
