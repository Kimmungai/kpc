<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use SoftDeletes;
    use Searchable;
    protected $guarded = ['id'];

    public function Dept()
    {
      return $this->belongsTo('App\Dept');
    }

    public function Purchase()
    {
      return $this->belongsToMany('App\Purchase');
    }

    public function Booking()
    {
      return $this->belongsToMany('App\Booking');
    }

    public function Report()
    {
      return $this->belongsToMany('App\Report');
    }

    public function Revenue()
    {
      return $this->belongsToMany('App\Revenue');
    }

    public function Expense()
    {
      return $this->belongsToMany('App\Expense');
    }
}
