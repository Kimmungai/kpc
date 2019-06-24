<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
  use SoftDeletes;

  public function User()
  {
    return $this->belongsTo('App\User');
  }

  public function Dept()
  {
    return $this->belongsTo('App\Dept');
  }

  public function Expense()
  {
    return $this->hasMany('App\Expense');
  }

  /*public function Product()
  {
    return $this->hasMany('App\Product');
  }*/
}
