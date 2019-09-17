<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dept;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $depts = Dept::all();

        if( Auth::user()->type == -1 ){

          return view('user.super-admin',compact('depts'));

        }elseif ( Auth::user()->type == 1 ) {

          return view('user.staff',compact('depts'));

        }elseif ( Auth::user()->type == 3 ) {

          return view('user.admin',compact('depts'));
        }

        return view('home',compact('depts'));
    }
}
