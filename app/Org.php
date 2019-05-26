<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
    public function Dept()
    {
      $this->hasMany('App\Dept');
    }

    public function User()
    {
      $this->hasMany('App\User');
    }
}
