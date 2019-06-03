<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Purchase;
use App\Expense;
use Carbon\Carbon;

class UserAjaxController extends Controller
{
    public function search_user( Request $request )
    {
      $string = $request->string;
      $users = User::where('firstName', 'LIKE',  $string . '%')->where('type',5)->get();
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
        /*$expense = new Expense;
        $expense->purchase_id = $purchase->id;
        $expense->save();*/
        $data[0] = $user;
        $data[1] = $purchase;
        return $data;
      }
    }
}
