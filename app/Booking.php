<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
   use SoftDeletes;

    protected $guarded = ['id'];

    public function User()
    {
      return $this->belongsTo('App\User');
    }

    public function Dept()
    {
      return $this->belongsTo('App\Dept');
    }

    public function Revenue()
    {
      return $this->hasMany('App\Revenue');
    }

    public function BookingMenu()
    {
      return  $this->hasMany('App\BookingMenu');
    }
    public function BookingServices()
    {
      return $this->hasMany('App\BookingServices');
    }
    public function DeptBookingTypes()
    {
      return $this->hasOne('App\DeptBookingTypes','id','bookingType');
    }
    public function DeptRooms()
    {
      return $this->hasOne('App\DeptRooms','id','dept_rooms_id');
    }
}
