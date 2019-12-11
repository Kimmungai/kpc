<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;

    public function Purchase()
    {
      return $this->belongsTo('App\Purchase');
    }

    public function Report()
    {
      return $this->belongsTo('App\Report');
    }

    public function Product()
    {
      return $this->hasOne('App\Product','id','product_id');
    }
}
