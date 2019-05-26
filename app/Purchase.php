<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
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

  public function Product()
  {
    $this->hasMany('App\Product');
  }
}
