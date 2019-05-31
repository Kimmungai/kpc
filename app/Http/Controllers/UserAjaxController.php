<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Purchase;
use Carbon\Carbon;

class UserAjaxController extends Controller
{
    public function search_user( Request $request )
    {
      $string = $request->string;
      $users = User::where('firstName', 'LIKE',  $string . '%')->get();
      return $users;
    }

    public function get_user(Request $request)
    {
      $id = $request->userID;
      if( $id )
      {
        $user = User::find($id);
        $purchase = new Purchase;
        $purchase->dept_id = $request->dept_id;
        $purchase->user_id = $user->id;
        $purchase->deleted_at = Carbon::now();
        $purchase->save();
        $data[0] = $user;
        $data[1] = $purchase;
        return $data;
      }
    }
}
