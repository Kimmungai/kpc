<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
  use SoftDeletes;

  public function Dept()
  {
    return $this->belongsTo('App\Dept');
  }

  public function Product()
  {
    return $this->hasMany('App\Product');
  }

  public function Expense()
  {
    return $this->hasMany('App\Expense');
  }

  public function Revenue()
  {
    return $this->hasMany('App\Revenue');
  }
}
