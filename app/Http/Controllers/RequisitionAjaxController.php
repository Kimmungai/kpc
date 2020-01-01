<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Notifications\RequisitionApproved;
use App\Notifications\RequisitionRejected;
use Notification;
use App\Requisition;
use App\User;
use Carbon\Carbon;
use Auth;
use App\Product;
use App\Expense;
use App\Purchase;

class RequisitionAjaxController extends Controller
{
    public function requisition_approval( Request $request )
    {

      $request->validate([
        'requisition_id' => 'required|numeric',
        'status' => 'required|numeric',
      ]);

      $requisitionID = $request->requisition_id;
      $requisition = Requisition::find( $requisitionID );
      $status = $request->status;
      $userTypes = [-1,1,3];//only send to users of these types (super admins, staff and admins)
      $subscribedUsers = User::whereIn('type',$userTypes)->where('receive_notifications',1)->where('id','<>',Auth::id())->get();

      if( $status ){//set the approved by colum in requisition table to current user id
        Requisition::where('id',$requisitionID)->update([
          'approved_by' => Auth::id(),
          'doc_title' => 'Lpo',
          'approved_by_name' => Auth::user()->name,
          'approved_on' => Carbon::now(),
          'approval_status' => 1,
        ]);
        $this->send_req_approved_notification( $subscribedUsers, $requisition );
      }
      else {//set the approved by colum in requisition table to null
        Requisition::where('id',$requisitionID)->update([
          'approved_by' => null,
          'doc_title' => 'Requisition form',
          'approved_by_name' => Auth::user()->name,
          'approved_on' => null,
          'approval_status' => 0,
        ]);
        //goods not received
        $this->update_goods_received( $requisition->id, 0 );
        //delete purchase
        $this->delete_purchase( $requisition );
        //remove requisition product qtys
        $this->remove_req_products_qty( $requisition );

        $this->send_req_disapproved_notification( $subscribedUsers, $requisition );
      }

      return 1;

    }

    /**
    *Send subscribed users requisition form approved notifications
    *
    *@param $subscribedUsers
    */
    private function send_req_approved_notification( $subscribedUsers, $requisition )
    {
      Notification::send($subscribedUsers, new RequisitionApproved($this->type_of_notification_details( 1, $requisition )));
    }

    /**
    *Send subscribed users requisition form rejected notifications
    *
    *@param $subscribedUsers
    */
    private function send_req_disapproved_notification( $subscribedUsers, $requisition )
    {
      Notification::send($subscribedUsers, new RequisitionRejected($this->type_of_notification_details( 0, $requisition )));
    }

    /**
    *Get the Notification details depending on whether its approval or rejection of the requisition form
    *
    *@param $type
    */
    private function type_of_notification_details( $type = 0, $requisition )
    {
      $username = $requisition->user ? $requisition->user->name : '';
      $reference = $requisition->reference ? $requisition->reference : $requisition->id;
      $dept_name = $requisition->dept ? $requisition->dept->name : '';
      $avatar = url('/images/avatar-female.png');

      if( Auth::user()->avatar ){
        $avatar = Auth::user()->avatar;
      }else{
          if( Auth::user()->gender == 1 )
            {
              $avatar = url('/images/avatar-male.png');
            }
      }

      if( !$type )
      {
        $rejectDetails = [
                     'greeting' => 'Hi '.$username.',',
                     'subject' => 'Requisition request rejected',
                     'body' => 'Requisition request of reference number '.$reference.' from '.$dept_name.' department has been disapproved by '.Auth::user()->name.'',
                     'thanks' => 'Thank you for using Kitui Pastoral Center system',
                     'actionText' => 'View Requisition Form',
                     'actionURL' => route('requisition.show',$requisition->id),
                     'requisition_id' => $requisition->id,
                     'dept_name' => $dept_name,
                     'approver_name' => Auth::user()->name,
                     'approver_avatar' => $avatar,
                     'requisition_number' => $requisition->requisition_number,
                 ];
         return $rejectDetails;
      }
      else
      {
        $approveDetails = [
                     'greeting' => 'Hi '.$username.',',
                     'subject' => 'Requisition request approved',
                     'body' => 'Requisition request of reference number '.$reference.' from '.$dept_name.' department has been approved by '.Auth::user()->name.'',
                     'thanks' => 'Thank you for using Kitui Pastoral Center system',
                     'actionText' => 'View Requisition Form',
                     'actionURL' => route('requisition.show',$requisition->id),
                     'requisition_id' => $requisition->id,
                     'dept_name' => $dept_name,
                     'approver_name' => Auth::user()->name,
                     'approver_avatar' => $avatar,
                     'requisition_number' => $requisition->requisition_number,
                 ];

        return $approveDetails;
      }
    }

    /*
    *Receive LPO goods
    */
    public function requisition_goods_received( Request $request )
    {
     $request->validate([
        'requisition_id' => 'required|numeric',
      ]);

      $requisitionID = $request->requisition_id;

      $requisition = Requisition::find( $requisitionID );

      $this->update_goods_received( $requisitionID );

      //create suppplier
      $supplier = $this->create_supplier( $requisition );

      //create purchase
      $purchase = $this->create_purchase( $requisition, $supplier );

      //create product
      $this->create_products( $requisition, $purchase );

    }


    /*
    *update goods received
    */
    private function update_goods_received( $id, $status=1 )
    {
      Requisition::where('id',$id)->update([
        'goods_received' => $status,
      ]);

      return true;
    }

    /*
    *create supplier
    */
    private function create_supplier( $requisition )
    {

      if( $requisition->supplier_id ){
        $this->update_req_supplier( $requisition );
        return User::find($requisition->supplier_id);
      }

      $user = new User;
      $user->firstName = $requisition->supplier_name;
      $user->name = $requisition->supplier_name;
      $user->dept = $requisition->dept_id;
      $user->org = $requisition->supplier_org;
      $user->email = $requisition->supplier_email;
      $user->phoneNumber = $requisition->supplier_phone;
      $user->address = $requisition->supplier_addr;
      $user->type = 5;//supplier
      $user->password = Hash::make(env('DEFAULT_PASSWORD','password'));
      $user->save();

      Requisition::where('id',$requisition->id)->update(['supplier_id' => $user->id]);

      return $user;
    }

    /*
    *update supplier
    */
    private function update_req_supplier( $requisition )
    {
      $update = User::where('id',$requisition->supplier_id)->update([
        'firstName' => $requisition->supplier_name,
        'org' => $requisition->supplier_org,
        'email' => $requisition->supplier_email,
        'name' => $requisition->supplier_name,
        'dept' => $requisition->dept_id,
        'phoneNumber' => $requisition->supplier_phone,
        'address' => $requisition->supplier_addr,
      ]);

      if( $update )
        return true;

      return false;
    }

    /*
    *create purchase
    */
    private function create_purchase( $requisition, $supplier )
    {
      $purchase = new Purchase;
      $purchase->dept_id = $requisition->dept_id;
      $purchase->requisition_id = $requisition->id;
      $purchase->paymentMethod = 3;
      $purchase->amountDue = $requisition->req_grandtotal;
      $purchase->user_id = $supplier->id;
      $purchase->save();

      return $purchase;
    }

    /*
    *delete purchase
    */
    private function delete_purchase( $requisition )
    {
      return Purchase::where('requisition_id',$requisition->id)->delete();
    }

    /*
    *create products & expenses
    */
    private function create_products( $requisition, $purchase )
    {

      foreach ( $requisition->RequisitionProducts as $reqProd )
      {
        //check if the product already in // DB
        $product = Product::where('name',$reqProd->name)->where('description',$reqProd->description)->where('unitsOfMeasure',$reqProd->unitsOfMeasure)->where('price',$reqProd->price)->where('cost',$reqProd->cost)->first();

        if( $product )
        {
          $this->update_product_qty($product,$reqProd);

        }else {

        $product = new Product;
        $product->sku = $reqProd->name;
        $product->name = $reqProd->name;
        $product->quantity = $reqProd->quantity;
        $product->price = $reqProd->price;
        $product->cost = $reqProd->cost;
        $product->description = $reqProd->description;
        $product->purchases_id = $purchase->id;
        $product->dept_id = $requisition->dept_id;
        $product->requisition_prod_id = $reqProd->id;
        $product->unitsOfMeasure = $reqProd->unitsOfMeasure;
        $product->save();

       }

        $expense = new Expense;
        $expense->purchase_id = $purchase->id;
        $expense->product_id = $product->id;
        $expense->cost = $reqProd->cost;
        $expense->user_id=$purchase->user_id;
        $expense->paid=$purchase->paid;
        $expense->suppliedQuantity = $reqProd->quantity;
        $expense->total = ($reqProd->cost * $reqProd->quantity);
        $expense->save();
      }


    }

    /*
    *Update product
    */
    private function update_product_qty( $product,$reqProd )
    {
      $update = Product::where('id',$product->id)->update([

        'quantity' => ($reqProd->quantity + $product->quantity),

      ]);

      if($update)
        return true;

      return false;

    }

    /*
    *Function to remove the quantities of products from a disapproved requisition
    */
    private function remove_req_products_qty( $requisition )
    {
      foreach ( $requisition->RequisitionProducts as $reqProd )
      {
        Product::where('requisition_prod_id',$reqProd->id)->decrement('quantity',$reqProd->quantity);
      }
    }

}
