<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
  use SoftDeletes;
  
  public function Dept()
  {
    $this->belongsTo('App\Dept');
  }

  public function Product()
  {
    $this->hasMany('App\Product');
  }

  public function Expense()
  {
    $this->hasMany('App\Expense');
  }

  public function Revenue()
  {
    $this->hasMany('App\Revenue');
  }
}
