<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Purchase;
use App\Expense;
use Carbon\Carbon;
use Validator;

class UserAjaxController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    public function search_user( Request $request,$type=5 )
    {
      $string = $request->string;
      $users = User::where('firstName', 'LIKE',  $string . '%')->where('type',$type)->get();
      return $users;
    }

    public function search_any_user( Request $request )
    {
      $string = $request->string;
      if($request->type)
      {
        $users = User::where('firstName', 'LIKE',  $string . '%')->where('type',$request->type)->get();
      }
      else
      {
        $users = User::where('firstName', 'LIKE',  $string . '%')->get();
      }
      return $users;
    }

    public function get_purchases_user(Request $request)
    {
      $id = $request->userID;
      $purchaseID = $request->purchaseID;
      if( $id && $purchaseID )
      {
        $user = User::find($id);
        $purchase =  Purchase::find($purchaseID);

        $data[0] = $user;
        $data[1] = $purchase;
        return $data;

      }else if($id){

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

    public function get_user(Request $request)
    {
      $id = $request->userID;
      if( $id )
      {
        $user = User::find($id);
        return $user;
      }
    }

    public function create_user(Request $request)
    {
      $validator = Validator::make($request->all(),[
        'type' => 'required|numeric',
        'org_id' => 'required|numeric',
        'dept' => 'required|numeric',
        'avatar' => 'nullable|image|mimes:jpeg,bmp,png|max:1024',
        'firstName' => 'required|max:255',
        'lastName' => 'nullable|max:255',
        'DOB' => 'nullable|date|max:255',
        'email' => 'required|email|max:255|unique:users,email,'.\Request::segment(2),
        'phoneNumber' => 'required|numeric|digits_between:10,15',
        'gender' => 'nullable|numeric',
        'address' => 'nullable|max:255',
        'idNo' => 'nullable|numeric|digits_between:5,10',
        'passport' => 'nullable|max:255',
        'idImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        'passportImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        'password' => 'nullable|min:8|max:255',
      ]);

      if ($validator->fails()) {
          return response()->json($validator->errors());
      }
      $userData = $request->all();
      $userData['password'] = Hash::make(env('DEFAULT_PASSWORD','secret'));
      $user = User::create($userData);

      return $user;
    }
}
