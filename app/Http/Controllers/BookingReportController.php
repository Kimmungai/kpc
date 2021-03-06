<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use App\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\BookingReport;
use PDF;
class BookingReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dt = Carbon::now();
        $bookings= Booking::whereMonth('created_at', $dt->month)->where('status',1)->orderBy('created_at','DESC')->get();
        return view('Reports.booking-report',compact('bookings'));
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
    public function show(Booking $booking)
    {
        //
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
    public function destroy(Booking $booking)
    {
        //
    }

    public function report(Request $request)
    {
      $dt = Carbon::now();
      if( count($request->all()) )
      {

        if($request->duration_sort === 'thisWeek'){
          $bookings= Booking::whereDate('created_at','>=', $dt->startOfWeek())->where('status',1)->whereDate('created_at','<=', $dt->endOfWeek())->orderBy('created_at','DESC')->get();
          return view('Reports.booking-report',compact('bookings'));
        }
        if($request->duration_sort === 'thisYear') {
          $bookings= Booking::whereYear('created_at', $dt->year)->where('status',1)->orderBy('created_at','DESC')->get();
          return view('Reports.booking-report',compact('bookings'));
        }
        if($request->duration_sort === 'today'){
          $bookings= Booking::whereDay('created_at', $dt->day )->where('status',1)->orderBy('created_at','DESC')->get();
          return view('Reports.booking-report',compact('bookings'));
        }
      }
      if($request->duration_sort === 'dates'){
        $startDate = Carbon::now()->startOfMonth();
        if($request->filter_from != ''){ $startDate = Carbon::create($request->filter_from);}
        $endDate = Carbon::now();
        if($request->filter_to != ''){ $endDate =Carbon::create($request->filter_to); }

        $bookings= Booking::whereDate('created_at','>=', $startDate)->where('status',1)->whereDate('created_at','<=', $endDate)->orderBy('created_at','DESC')->get();
        return view('Reports.booking-report',compact('bookings'));
      }

      return redirect(route('booking-report.index'));
    }

    public function download(Request $request)
    {
      $dt = Carbon::now();

      if($request->duration_sort === 'thisWeek'){
        $startDate =$dt->startOfWeek();
        $endDate = $dt->copy()->endOfWeek();
        $bookings= Booking::whereDate('created_at','>=', $dt->startOfWeek())->where('status',1)->whereDate('created_at','<=', $dt->endOfWeek())->orderBy('created_at','DESC')->get();
      }
      elseif($request->duration_sort === 'thisYear') {
        $startDate =$dt->startOfYear();
        $endDate = $dt->copy()->endOfYear();
        $bookings= Booking::whereYear('created_at', $dt->year)->where('status',1)->orderBy('created_at','DESC')->get();
      }
      elseif($request->duration_sort === 'today'){
        $startDate =$dt->today();
        $endDate = $dt->copy()->today();
        $bookings= Booking::whereDay('created_at', $dt->day )->where('status',1)->orderBy('created_at','DESC')->get();
      }
      elseif($request->duration_sort === 'dates'){
        $startDate = Carbon::now()->startOfMonth();
        if($request->filter_from != ''){ $startDate = Carbon::create($request->filter_from);}
        $endDate = Carbon::now();
        if($request->filter_to != ''){ $endDate =Carbon::create($request->filter_to); }
        $bookings= Booking::whereDate('created_at','>=', $startDate)->where('status',1)->whereDate('created_at','<=', $endDate)->orderBy('created_at','DESC')->get();
      }
      else {
        $startDate =$dt->startOfMonth();
        $endDate = $dt->copy()->endOfMonth();
        $bookings= Booking::whereMonth('created_at', $dt->month)->where('status',1)->orderBy('created_at','DESC')->get();
      }


      $docs = $bookings;

      $pdf = PDF::loadView('pdf.all-bookings-report',compact('docs','startDate','endDate'));
      return $pdf->download();
    }

    public function share(Request $request)
    {
      $request->validate([
        'email' => 'required|email|max:255',
        'duration_sort' => 'required|max:255',
        'filter_from' => 'nullable|max:255',
        'filter_to' => 'nullable|max:255',
      ]);

      $email = $request->email;
      $duration_sort =$request->duration_sort;
      $filter_from =$request->filter_from;
      $filter_to = $request->filter_to;

      //send email
      $pathToPDF = $this->tmp_pdf_path($duration_sort,$filter_from,$filter_to);
      Mail::to($email)->queue(new BookingReport($pathToPDF));
      unlink($pathToPDF);
      return 1;
    }

    public function tmp_pdf_path($duration_sort,$filter_from,$filter_to)
    {
      $dt = Carbon::now();

      if($duration_sort === 'thisWeek'){
        $startDate =$dt->startOfWeek();
        $endDate = $dt->copy()->endOfWeek();
        $bookings= Booking::whereDate('created_at','>=', $dt->startOfWeek())->where('status',1)->whereDate('created_at','<=', $dt->endOfWeek())->orderBy('created_at','DESC')->get();
      }
      elseif($duration_sort === 'thisYear') {
        $startDate =$dt->startOfYear();
        $endDate = $dt->copy()->endOfYear();
        $bookings= Booking::whereYear('created_at', $dt->year)->where('status',1)->orderBy('created_at','DESC')->get();
      }
      elseif($duration_sort === 'today'){
        $startDate =$dt->today();
        $endDate = $dt->copy()->today();
        $bookings= Booking::whereDay('created_at', $dt->day )->where('status',1)->orderBy('created_at','DESC')->get();
      }
      elseif($duration_sort === 'dates'){
        $startDate = Carbon::now()->startOfMonth();
        if($filter_from != ''){ $startDate = Carbon::create($filter_from);}
        $endDate = Carbon::now();
        if($filter_to != ''){ $endDate =Carbon::create($filter_to); }
        $bookings= Booking::whereDate('created_at','>=', $startDate)->where('status',1)->whereDate('created_at','<=', $endDate)->orderBy('created_at','DESC')->get();
      }
      else {
        $startDate =$dt->startOfMonth();
        $endDate = $dt->copy()->endOfMonth();
        $bookings= Booking::whereMonth('created_at', $dt->month)->where('status',1)->orderBy('created_at','DESC')->get();
      }


      $docs = $bookings;
      $pdf = PDF::loadView('pdf.all-bookings-report',compact('docs','startDate','endDate'));
      $pdf->save('doc-'.$dt.'.pdf');
      $pathToPDF = 'doc-'.$dt.'.pdf';
      return $pathToPDF;
    }


}
