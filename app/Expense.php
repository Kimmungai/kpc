<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;
    
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
