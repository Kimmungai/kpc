<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
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

  public function Expense()
  {
    $this->hasMany('App\Expense');
  }

  /*public function Product()
  {
    $this->hasMany('App\Product');
  }*/
}
