<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public function Purchase()
    {
      $this->belongsTo('App\Purchase');
    }

    public function Report()
    {
      $this->belongsTo('App\Report');
    }

    public function Product()
    {
      $this->belongsTo('App\Product');
    }
}
