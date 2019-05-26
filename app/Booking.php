<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function User()
    {
      $this->belongsTo('App\User');
    }

    public function Dept()
    {
      $this->belongsTo('App\Dept');
    }

    public function Revenue()
    {
      $this->hasOne('App\Revenue');
    }

    public function Product()
    {
      $this->hasMany('App\Product');
    }
}
