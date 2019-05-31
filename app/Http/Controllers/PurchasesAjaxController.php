<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use Validator;
use App\User;
use App\Purchase;

class PurchasesAjaxController extends Controller
{
    public function create_supplier(Request $request)
    {

      $validator = Validator::make($request->all(), [
        'firstName' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'phoneNumber' => 'required|numeric|digits_between:10,15',
        'dept_id' => 'required|numeric',
        'paymentMethod' => 'required|numeric',
        'amountDue' => 'required|numeric',
        'amountPaid' => 'required|numeric',
      ]);

    if ($validator->fails()) {
        return response()->json($validator->errors());
    }

    $user = new User;
    $user->firstName = $request->firstName;
    $user->email = $request->email;
    $user->phoneNumber = $request->phoneNumber;
    $user->type = 5;//supplier
    $user->password = Hash::make($request->password);
    $user->save();

    //create purchase
    $purchase = $this->create_purchase($user->id,$request->only(['dept_id','paymentMethod','amountDue','amountPaid']));

    $data[0] = $user;
    $data[1] = $purchase;
    return $data;

    }

    public function create_purchase($userID,$data)//fill purchases table
    {
      $purchase = new Purchase;
      $purchase->dept_id = $data['dept_id'];
      $purchase->paymentMethod = $data['paymentMethod'];
      $purchase->amountDue = $data['amountDue'];
      $purchase->amountPaid = $data['amountPaid'];
      $purchase->user_id = $userID;
      $purchase->deleted_at = Carbon::now();
      $purchase->save();
      return $purchase;
    }

    public function restore_purchase( Request $request )//restore deleted user
    {
      $id = $request->purchases_id;
      if( $id )
      {
        if( $user = Purchase::withTrashed()->where('id',$id)->first() )
        {
          $user->restore();
          return 1;
        }
      }
      return 0;
    }
}
