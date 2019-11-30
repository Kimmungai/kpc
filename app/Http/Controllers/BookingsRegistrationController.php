<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Booking;
use App\Revenue;
use App\BookingMenu;
use App\BookingServices;
use App\Product;
use App\Dept;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;

class BookingsRegistrationController extends Controller
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
    public function index(Request $request)
    {
      $sortField='created_at';$sortValue='DESC';
      $status =' id != "" ';
      $sortBy = $request->filter_sort;
      $startDate = $request->filter_from != null ?  Carbon::create($request->filter_from) : null;
      $endDate = $request->filter_to != null ?  Carbon::create($request->filter_to) : null;
      if($sortBy)
      {
        if( $sortBy == 'oldNew' ){$sortField='created_at';$sortValue='ASC';}
        if( $sortBy == 'paidOnly' ){ $status ='bookingAmountDue-bookingAmountReceived <= 0'; }
        if( $sortBy == 'pendingOnly' ){ $status ='bookingAmountDue-bookingAmountReceived > 0'; }
        if( $sortBy == 'overPaidOnly' ){ $status ='bookingAmountDue-bookingAmountReceived < 0'; }
      }

      if(Session('deptID') != null ){
        $dept = Dept::find(Session('deptID'));
        if( $startDate && $endDate)
        {

          $bookings = Booking::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereDate('created_at','>=',$startDate)->whereDate('created_at','<=',$endDate)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

        }elseif($startDate){

          $bookings = Booking::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereDate('created_at','>=',$startDate)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

        }else{

          $bookings = Booking::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

        }
        return view('bookings.index',compact('bookings','dept','sortBy','startDate','endDate'));
      }else{

        $bookings = Booking::paginate(env('ITEMS_PER_PAGE',5));

      }

      return view('bookings.index',compact('bookings','sortBy','startDate','endDate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if(Session('deptID') == null )
      {
        Session::flash('error', 'Please select a department');
        return redirect('home');
      }
      $dept = Dept::find(Session('deptID'));
      return view('bookings.create',compact('dept'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bookingData = $this->booking_data( $request );
        //create booking
        $booking = Booking::create( $bookingData );

        //create revenue (booked products)
        $this->save_other_booked_products( $request, $booking->id );

        //create booking menu
        $this->create_booking_menu( $request, $booking->id );

        //create booking services (Other services booked)
        $this->create_booking_services( $request, $booking->id );

        //notify Admin, Staff, super admin

        Session::flash('message', env("SAVE_SUCCESS_MSG","Details saved successfully!"));
        return redirect(route('bookings-registration.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking,$id)
    {
      $dept ='';
      $booking = Booking::with(['user','revenue.product'])->where('id',$id)->first();
      if(Session('deptID') != null ){
      $dept = Dept::find(Session('deptID'));
    }else{
        Session::flash('error', 'Please select a department');
        return redirect('home');
    }
      return view('bookings.show',compact('booking','dept'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking,$id)
    {
      $dept ='';
      $booking = Booking::with(['user','revenue.product'])->where('id',$id)->first();
      if(Session('deptID') != null ){
      $dept = Dept::find(Session('deptID'));
      }
      return view('bookings.edit',compact('booking','dept'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking,$id)
    {
      $booking = Booking::find($id);
      Revenue::where('booking_id',$id)->forceDelete();
      $booking->forceDelete();
      Session::flash('message', env("DELETE_SUCCESS_MSG","Records removed succesfully!"));
      return redirect('/bookings-registration');
    }

    public function download($id)
    {
      $doc = Booking::find($id);
      $pdf = PDF::loadView('pdf.booking-report',compact('doc'));
      return $pdf->download();
    }

    /**
    *Save other products booked
    *
    *@param $request
    *@return $success or $fail
    */
    private function save_other_booked_products( $request, $booking_id, $action='create' )
    {
      if( $action == 'update' )//delete all requisition products first
      {
        Revenue::where('booking_id',$booking_id)->forceDelete();
      }

      $no_prods = $request->no_products;

      for( $i = 1; $i <= $no_prods; $i++ )
      {
        if( !$request->has( 'col_'.$i.'_7' ) ){$no_prods++;continue;}

        $revenue = new Revenue;
        $revenue->booking_id = $booking_id;
        $revenue->product_id = $request['col_'.$i.'_7'];
        $revenue->bookedQuantity = $request['col_'.$i.'_4'];
        $revenue->price = $request['col_'.$i.'_5'];
        $revenue->total = $request['col_'.$i.'_6'];
        //reduce stock
        $this->reduceStock( $request['col_'.$i.'_7'], $request['col_'.$i.'_4']);
        $revenue->save();
      }

    }

    //reduce stock
    protected function reduceStock($prodId, $reduceQty)
    {
      $product = Product::find($prodId);
      $newQuantity = $product->quantity - $reduceQty;
      if(Product::where('id',$prodId)->update(['quantity'=>$newQuantity]))
      {
        return true;
      }
      return false;
    }

    //create menu selected in this booking
    private function create_booking_menu( $request, $booking_id )
    {
      foreach ($request->booking_menu as $menu )
      {
        $bookingMenu = new BookingMenu;
        $bookingMenu->dept_menus_id = $menu;
        $bookingMenu->booking_id = $booking_id;
        $bookingMenu->save();
      }
    }

    //create services selected for this booking
    private function create_booking_services( $request, $booking_id )
    {
      foreach ($request->other_services as $service )
      {
        $bookingService = new BookingServices;
        $bookingService->dept_services_id = $service;
        $bookingService->booking_id = $booking_id;
        $bookingService->save();
      }
    }

    //return data for booking table from request
    private function booking_data( $request )
    {
      return $request->only([
        'bookingType',
        'numPple',
        'dept_rooms_id',
        'chkInDate',
        'chkOutDate',
        'modeOfPayment',
        'transactionCode',
        'bookingAmountReceived',
        'paymentDueDate',
        'booked_prods_grand_total',
        'user_id',
        'booking_num_days',
        'bookingAmountDue',
        'no_products',
        'dept_id',
      ]);
    }

}
