<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class UserController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function users_top()
  {
    $usersCount['staff'] = count(User::where('type',1)->get());
    $usersCount['customers'] = count(User::where('type',2)->get());
    $usersCount['administrators'] = count(User::where('type',3)->get());
    $usersCount['casuals'] = count(User::where('type',4)->get());
    return view('user.index',compact('usersCount'));
  }

}
