<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Booking;
use App\Dept;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingsRegistrationController extends Controller
{
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
        if( $sortBy == 'paidOnly' ){ $status ='bookingAmountDue-bookingAmountReceived = 0'; }
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking,$id)
    {
      $booking = Booking::with(['user','revenue.product'])->where('id',$id)->first();
      $dept = Dept::find(Session('deptID'));
      return view('bookings.edit',compact('booking','dept'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
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
      $booking->forceDelete();
      Session::flash('message', env("DELETE_SUCCESS_MSG","Records removed succesfully!"));
      return redirect('/bookings-registration');
    }
}
