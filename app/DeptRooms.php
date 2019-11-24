<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeptRooms extends Model
{
  protected $guarded = ['id'];
  
  public function Dept()
  {
    return $this->belongsTo('App\Dept');
  }
}
