<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\RequisitionApproved;
use App\Notifications\RequisitionRejected;
use Notification;
use App\Requisition;
use App\User;

use Auth;

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
          'approval_status' => 1,
        ]);
        $this->send_req_approved_notification( $subscribedUsers, $requisition );
      }
      else {//set the approved by colum in requisition table to null
        Requisition::where('id',$requisitionID)->update([
          'approved_by' => null,
          'approval_status' => 0,
        ]);
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
                 ];

        return $approveDetails;
      }
    }
}
