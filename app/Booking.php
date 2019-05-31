<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
   use SoftDeletes;

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
