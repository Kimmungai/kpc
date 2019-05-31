<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
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
