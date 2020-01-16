<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Mail\PurchaseMail;
use Validator;
use App\User;
use App\Purchase;
use App\Expense;
use PDF;
class PurchasesAjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
    $user->dept = $request->dept_id;
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
      /*$expense = new Expense;
      $expense->purchase_id = $purchase->id;
      $expense->save();*/
      return $purchase;
    }

    public function restore_purchase( Request $request )//restore deleted user
    {
      $id = $request->purchases_id;
      if( $id )
      {
        if( $purchase = Purchase::withTrashed()->where('id',$id)->first() )
        {
          $purchase->restore();
          return 1;
        }
      }
      return 0;
    }

    public function update_purchase( Request $request )
    {
      $id = $request->purchases_id;
      if( $purchase = Purchase::withTrashed()->where('id',$id)->first() )
      {
        $purchase->restore();
      }

      $field = $request->field;
      $value = $request->value;
      if( $id )
      {
        Purchase::where('id',$id)->update([
          $field => $value
        ]);
      }
    }

    public function share(Request $request)
    {
      $request->validate([
        'email' => 'required|email|max:255',
        'id' => 'required|numeric',
      ]);

      $email = $request->email;
      $purchase = Purchase::find($request->id);

      //send email
      $doc = $purchase;
      $pdf = PDF::loadView('pdf.purchase-report',compact('doc'));
      $pathToPDF = 'doc-'.$doc->id.'.pdf';
      $pdf->save($pathToPDF);
      Mail::to($email)->queue(new PurchaseMail($pathToPDF));
      unlink($pathToPDF);
      return 1;
    }
}
