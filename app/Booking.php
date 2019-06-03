<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
   use SoftDeletes;

   protected $fillable = [
     'dept_id','user_id','bookingType','roomType','numPple','chkInDate','chkOutDate','bookingAmountDue','modeOfPayment','bookingAmountReceived','paymentStatus','paymentDueDate','board','menu','menuDetails','meetingHall','tent','paSystem','projector',
   ];

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
