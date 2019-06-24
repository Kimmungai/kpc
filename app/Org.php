<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Org extends Model
{
    use SoftDeletes;

    public function Dept()
    {
      return $this->hasMany('App\Dept');
    }

    public function User()
    {
      return $this->hasMany('App\User');
    }
}
