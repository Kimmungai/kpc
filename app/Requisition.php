<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
  use Notifiable;
  protected $guarded = ['id'];

  public function RequisitionProducts()
  {
    return $this->hasMany('App\RequisitionProducts');
  }

  public function Dept()
  {
    return $this->belongsTo('App\Dept');
  }

  public function User()
  {
    return $this->belongsTo('App\User', 'request_by');
  }
}
