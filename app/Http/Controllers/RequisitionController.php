<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Requisition;
use App\RequisitionProducts;
use App\Notifications\RequisitionRequest;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequisition;
use App\Dept;
use App\User;
use Notification;
use Auth;

class RequisitionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::user()->type == -1 || Auth::user()->type == 3 )
        {
          $requisitions = Requisition::orderBy('created_at','DESC')->paginate( env('ITEMS_PER_PAGE',5) );
        }
        else
        {
          $requisitions = Requisition::where('approval_status','<>',null)->orderBy('created_at','DESC')->paginate( env('ITEMS_PER_PAGE',5) );
        }

        foreach (Auth::user()->unreadNotifications as $notification)
        {
          if( $notification->type == 'App\Notifications\RequisitionApproved' || $notification->type == 'App\Notifications\RequisitionRejected' || $notification->type == 'App\Notifications\RequisitionRequest' )
            $notification->markAsRead();
        }

        return view('requisition.index',compact('requisitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dept = Dept::find(Session('deptID'));
        return view('requisition.create',compact('dept'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequisition $request)
    {
        $data = $request->only([
          'dept_id',
          'request_by',
          'vat_percent',
          'vat_total',
          'description',
          'company_name',
          'company_addr',
          'company_city',
          'doc_title',
          'supplier_name',
          'requisition_number',
          'supplier_addr',
          'supplier_org',
          'supplier_email',
          'supplier_id',
          'supplier_phone',
          'req_subtotal',
          'req_grandtotal',
          'no_products',
        ]);
       $requisition = Requisition::create($data);
       $this->save_requisition_products( $request, $requisition->id );


       //Send notification
       $authorisedUsers = [-1,3];

       $subscribedUsers = User::whereIn('type',$authorisedUsers)->where('id','<>',Auth::id())->where('receive_notifications',1)->get();
       $dept = Dept::find($requisition->dept_id);
       $requester = User::find($request->request_by);
       $this->send_notifications( $subscribedUsers, $requisition->id, $dept, $requester );

       Session::flash('message', "Requisition form submitted succesfully!");
       return redirect(route('product-registration.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function show(Requisition $requisition)
    {
        $dept = Dept::find(Session('deptID'));

        if( Auth::check() ){
          $this->mark_notifications_read( Auth::user(), $requisition );
        }
        return view('requisition.show',compact('dept','requisition'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function edit(Requisition $requisition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisition $requisition)
    {
        $data = $request->only([
          'dept_id',
          'request_by',
          'vat_percent',
          'vat_total',
          'description',
          'company_name',
          'company_addr',
          'company_city',
          'doc_title',
          'supplier_name',
          'requisition_number',
          'supplier_addr',
          'supplier_org',
          'supplier_email',
          'supplier_id',
          'supplier_phone',
          'req_subtotal',
          'req_grandtotal',
          'no_products',
        ]);

       Requisition::where('id',$requisition->id)->update($data);
       $this->save_requisition_products( $request, $requisition->id, 'update' );

       Session::flash('message', "Requisition form updated succesfully!");
       return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisition $requisition)
    {
        //
    }

    /**
    *Save products associated to a given requisition
    *
    *@param $request
    *@return $success or $fail
    */
    private function save_requisition_products( $request, $requisition_id, $action='create' )
    {
      if( $action == 'update' )//delete all requisition products first
      {
        RequisitionProducts::where('requisition_id',$requisition_id)->delete();
      }

      $no_prods = $request->no_products;

      for( $i = 1; $i <= $no_prods; $i++ )
      {
        if( !$request->has( 'col-'.$i.'-1' ) ){$no_prods++;continue;}

        //first check wether sale price, cost and quantities have been specified
        if( $request['col-'.$i.'-3'] == null || $request['col-'.$i.'-4'] == null || $request['col-'.$i.'-5'] == null ){continue;}

        $new_prod = new RequisitionProducts;
        $new_prod->requisition_id = $requisition_id;
        $new_prod->name = $request['col-'.$i.'-1'];
        $new_prod->description = $request['col-'.$i.'-2'];
        $new_prod->price = $request['col-'.$i.'-3'];
        $new_prod->cost = $request['col-'.$i.'-4'];
        $new_prod->quantity = $request['col-'.$i.'-5'];
        $new_prod->unitsOfMeasure = $request['col-'.$i.'-6'];
        $new_prod->totalCost = $request['col-'.$i.'-7'];
        $new_prod->save();
      }

    }

    /**
    *Send users subscribed users notifications
    *
    *@param $subscribedUsers
    */
    private function send_notifications( $subscribedUsers, $requisitionID, $dept, $requester )
    {
      $avatar = url('/images/avatar-female.png');

      if( $requester->avatar ){
        $avatar = $requester->avatar;
      }else {
        if( $requester->gender == 1 )
        {
          $avatar = url('/images/avatar-male.png');
        }
      }

      $details = [
                   'greeting' => 'Hi Admin,',
                   'subject' => 'New requisition request',
                   'body' => 'A new requisition request from '.$dept->name.' department has been received. Requisition form has been filled by '.$requester->name,
                   'thanks' => 'Thank you for using Kitui Pastoral Center system',
                   'actionText' => 'View Requisition Form',
                   'actionURL' => route( 'requisition.show', $requisitionID ),
                   'requisition_id' => $requisitionID,
                   'dept_name' => $dept->name,
                   'requester_name' => $requester->name,
                   'requester_avatar' => $avatar,
               ];

      Notification::send($subscribedUsers, new RequisitionRequest($details));
    }

    /**
    *Mark notifications as read
    *
    *@param $user, $requisition
    */
    private function mark_notifications_read( $user, $requisition )
    {

      foreach ( $user->unreadNotifications as $notification )
      {
        if( !isset( $notification->data['requisition_id'] ) ){ continue; }

        if ( $notification->data['requisition_id'] == $requisition->id ) {
          $notification->markAsRead();
        }

      }

    }
}
