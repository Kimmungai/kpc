<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*protected function authenticated(Request $request, $user)
    {

  	 if ($user->type == -1)//super admin
     {
  	 	return redirect('/home');
     }
     else if ($user->type == 1)
     {
  	 	return redirect('/staff');
  	 }
     else if ($user->type == 2)
    {
     return redirect('/author');
    }
    else if ($user->type == 3)
    {
     return redirect('/dept-registration/'.$user->dept.'');
    }
    else if ($user->type == 4)
    {
     return redirect('/author');
    }
    else if ($user->type == 5)
    {
     return redirect('/author');
    }
    else
   {
	 	return redirect('/home');
  }

  }*/
}
