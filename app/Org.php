<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Org extends Model
{
    use SoftDeletes;
    
    public function Dept()
    {
      $this->hasMany('App\Dept');
    }

    public function User()
    {
      $this->hasMany('App\User');
    }
}
