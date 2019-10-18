<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
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
      $usersCount['suppliers'] = count(User::where('type',5)->get());

    }
    else
    {
      $usersCount['staff'] = count(User::where('type',1)->where('dept',Auth::user()->dept)->get());
      $usersCount['customers'] = count(User::where('type',2)->where('dept',Auth::user()->dept)->get());
      $usersCount['administrators'] = count(User::where('type',3)->where('dept',Auth::user()->dept)->get());
      $usersCount['casuals'] = count(User::where('type',4)->where('dept',Auth::user()->dept)->get());
      $usersCount['suppliers'] = count(User::where('type',5)->get());

    }

    return view('user.index',compact('usersCount'));
  }

  public function profile( $id )
  {
    if( $id == Auth::id() )
    {
      $profile = Auth::user();

    }
    else
    {
      $profile = User::find($id);
      $admins = [3,-1];//admin type
      $staffAdmins = [-1,1,3];//admins and staff
      $otherUsers = [2,4,5];//cusomers,casuals,suppliers
      if( $profile->type == -1  &&  Auth::user()->type != -1)
      {
        Session::flash('error', 'Sorry you are not authorised to perform this action.');
        return back();
      }
      if( $profile->type == 3 &&  !in_array( Auth::user()->type, $admins ) )
      {
        Session::flash('error', 'Sorry you are not authorised to perform this action.');
        return back();
      }
      if( $profile->type == 1  &&  !in_array( Auth::user()->type, $staffAdmins ) )
      {
        Session::flash('error', 'Sorry you are not authorised to perform this action.');
        return back();
      }
      if( in_array( Auth::user()->type, $otherUsers ) &&  ($id != Auth::id()) )
      {
        Session::flash('error', 'Sorry you are not authorised to perform this action.');
        return back();
      }
    }

    return view('user.profile',compact('profile'));

  }

}
