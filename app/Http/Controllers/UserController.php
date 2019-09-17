<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;


class UserController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function users_top()
  {
    if( Auth::user()->type == -1 )
    {
      $usersCount['staff'] = count(User::where('type',1)->get());
      $usersCount['customers'] = count(User::where('type',2)->get());
      $usersCount['administrators'] = count(User::where('type',3)->get());
      $usersCount['casuals'] = count(User::where('type',4)->get());
      $usersCount['super_admins'] = count(User::where('type',-1)->get());
    }
    else
    {
      $usersCount['staff'] = count(User::where('type',1)->where('dept',Auth::user()->dept)->get());
      $usersCount['customers'] = count(User::where('type',2)->where('dept',Auth::user()->dept)->get());
      $usersCount['administrators'] = count(User::where('type',3)->where('dept',Auth::user()->dept)->get());
      $usersCount['casuals'] = count(User::where('type',4)->where('dept',Auth::user()->dept)->get());
    }

    return view('user.index',compact('usersCount'));
  }

}
