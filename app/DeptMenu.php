<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeptMenu extends Model
{
  protected $guarded = ['id'];

  public function Dept()
  {
    return $this->belongsTo('App\Dept');
  }
}
