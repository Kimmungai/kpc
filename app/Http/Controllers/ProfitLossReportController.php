<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\ProfitLossReport;
use App\Expense;
use App\Revenue;
use App\Booking;
use App\Purchase;
use App\DeptSales;
use Carbon\Carbon;
use PDF;

class ProfitLossReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $totals = $this->get_totals();

      return view('Reports.profit-loss-report',compact('totals'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*
    *Function to get total revenue received from bookings
    */
    protected function get_total_revenue_received_from_bookings($startDate=null,$endDate=null,$duration_sort=null)
    {
      if($startDate && $endDate && $duration_sort)
      {
        return Booking::whereDate('created_at','>=', $startDate)->whereDate('created_at','<=', $endDate)->where('paid',1)->get()->sum('bookingAmountReceived');
      }
      elseif( $startDate && $duration_sort )
      {
        if( $duration_sort == 'year' )
          return Booking::whereYear('created_at', $startDate)->where('paid',1)->get()->sum('bookingAmountReceived');
        elseif( $duration_sort == 'month' )
          return Booking::whereMonth('created_at', $startDate )->where('paid',1)->get()->sum('bookingAmountReceived');
        elseif( $duration_sort == 'day' )
          return Booking::whereDay('created_at', $startDate )->where('paid',1)->get()->sum('bookingAmountReceived');
      }
      return Booking::where('paid',1)->get()->sum('bookingAmountReceived');
    }

    /*
    *Function to get total revenue
    */
    protected function get_total_revenue($startDate=null,$endDate=null,$duration_sort=null)
    {
      if($startDate && $endDate && $duration_sort)
      {
        return Revenue::whereDate('created_at','>=', $startDate)->whereDate('created_at','<=', $endDate)->where('paid',1)->where('booking_id',null)->where('dept_sales_id',null)->get()->sum('amountReceived');
      }
      elseif( $startDate && $duration_sort )
      {
        if( $duration_sort == 'year' )
          return Revenue::whereYear('created_at', $startDate)->where('paid',1)->where('booking_id',null)->where('dept_sales_id',null)->get()->sum('amountReceived');
        elseif( $duration_sort == 'month' )
          return Revenue::whereMonth('created_at', $startDate )->where('paid',1)->where('booking_id',null)->where('dept_sales_id',null)->get()->sum('amountReceived');
        elseif( $duration_sort == 'day' )
          return Revenue::whereDay('created_at', $startDate )->where('paid',1)->where('booking_id',null)->where('dept_sales_id',null)->get()->sum('amountReceived');
      }
      return Revenue::where('paid',1)->where('booking_id',null)->where('dept_sales_id',null)->get()->sum('amountReceived');
    }

    /*
    *Function to get total amount paid to suppliers
    */
    protected function get_total_paid_to_suppliers($startDate=null,$endDate=null,$duration_sort=null)
    {
      if($startDate && $endDate && $duration_sort)
      {
        return Purchase::whereDate('created_at','>=', $startDate)->whereDate('created_at','<=', $endDate)->where('paid',1)->get()->sum('amountPaid');
      }
      elseif( $startDate && $duration_sort )
      {
        if( $duration_sort == 'year' )
          return Purchase::whereYear('created_at', $startDate)->where('paid',1)->get()->sum('amountPaid');
        elseif( $duration_sort == 'month' )
          return Purchase::whereMonth('created_at', $startDate )->where('paid',1)->get()->sum('amountPaid');
        elseif( $duration_sort == 'day' )
          return Purchase::whereDay('created_at', $startDate )->where('paid',1)->get()->sum('amountPaid');
      }
      return Purchase::where('paid',1)->get()->sum('amountPaid');
    }

    /*
    *Function to get total expenses
    */
    protected function get_total_expenses($startDate=null,$endDate=null,$duration_sort=null)
    {
      if($startDate && $endDate && $duration_sort)
      {
        return Expense::whereDate('created_at','>=', $startDate)->whereDate('created_at','<=', $endDate)->where('paid',1)->where('purchase_id',null)->get()->sum('amountPaid');
      }
      elseif( $startDate && $duration_sort )
      {
        if( $duration_sort == 'year' )
          return Expense::whereYear('created_at', $startDate)->where('paid',1)->where('purchase_id',null)->get()->sum('amountPaid');
        elseif( $duration_sort == 'day' )
          return Expense::whereDay('created_at', $startDate )->where('paid',1)->where('purchase_id',null)->get()->sum('amountPaid');
        elseif( $duration_sort == 'month' )
          return Expense::whereMonth('created_at', $startDate )->where('paid',1)->where('purchase_id',null)->get()->sum('amountPaid');
      }
      return Expense::where('paid',1)->where('purchase_id',null)->get()->sum('amountPaid');
    }

    /*
    *Function to get total revenue received from deprtment sales
    */
    protected function get_total_sales($startDate=null,$endDate=null,$duration_sort=null)
    {
      if($startDate && $endDate && $duration_sort)
      {
        return DeptSales::whereDate('created_at','>=', $startDate)->whereDate('created_at','<=', $endDate)->where('paid',1)->get()->sum('saleAmountReceived');
      }
      elseif( $startDate && $duration_sort )
      {
        if( $duration_sort == 'year' )
          return DeptSales::whereYear('created_at', $startDate)->where('paid',1)->get()->sum('saleAmountReceived');
        elseif( $duration_sort == 'month' )
          return DeptSales::whereMonth('created_at', $startDate)->where('paid',1)->get()->sum('saleAmountReceived');
        elseif( $duration_sort == 'day' )
          return DeptSales::whereDay('created_at', $startDate )->where('paid',1)->get()->sum('saleAmountReceived');

      }
      return DeptSales::where('paid',1)->get()->sum('saleAmountReceived');
    }

    /*
    *Function to return the total array
    */
    private function get_totals($startDate=null,$endDate=null,$duration_sort=null)
    {
      $totals['booking'] = $this->get_total_revenue_received_from_bookings($startDate,$endDate,$duration_sort);
      $totals['revenue'] = $this->get_total_revenue($startDate,$endDate,$duration_sort);
      $totals['purchase'] = $this->get_total_paid_to_suppliers($startDate,$endDate,$duration_sort);
      $totals['expense'] = $this->get_total_expenses($startDate,$endDate,$duration_sort);
      $totals['sales'] = $this->get_total_sales($startDate,$endDate,$duration_sort);
      $totals['totalRevenue'] = $totals['sales'] + $totals['revenue'] + $totals['booking'];
      $totals['totalExpense'] =  $totals['purchase'] + $totals['expense'];
      $totals['netIncome'] = $totals['totalRevenue'] - $totals['totalExpense'];

      return $totals;
    }
    /*
    *Function to generate reports
    */
    public function report(Request $request)
    {
      $dt = Carbon::now();
      if( count($request->all()) )
      {

        if($request->duration_sort === 'thisWeek'){
          $totals = $this->get_totals( $dt->startOfWeek(), $dt->endOfWeek(), 'week' );
          //$purchases= Purchase::whereDate('created_at','>=', $dt->startOfWeek())->whereDate('created_at','<=', $dt->endOfWeek())->orderBy('created_at','DESC')->get();
          return view('Reports.profit-loss-report',compact('totals'));
        }
        if($request->duration_sort === 'thisYear') {
          $totals = $this->get_totals( $dt->year, null, 'year' );
          //$purchases= Purchase::whereYear('created_at', $dt->year)->orderBy('created_at','DESC')->get();
          return view('Reports.profit-loss-report',compact('totals'));
        }
        if($request->duration_sort === 'today'){
          $totals = $this->get_totals( $dt->day, null, 'day' );
          //$purchases= Purchase::whereDay('created_at', $dt->day )->orderBy('created_at','DESC')->get();
          return view('Reports.profit-loss-report',compact('totals'));
        }
      }
      if($request->duration_sort === 'dates'){
        $startDate = Carbon::now()->startOfMonth();
        if($request->filter_from != ''){ $startDate = Carbon::create($request->filter_from);}
        $endDate = Carbon::now();
        if($request->filter_to != ''){ $endDate =Carbon::create($request->filter_to); }

        $totals = $this->get_totals( $startDate, $endDate, 'dates' );
        //$purchases= Purchase::whereDate('created_at','>=', $startDate)->whereDate('created_at','<=', $endDate)->orderBy('created_at','DESC')->get();
        return view('Reports.profit-loss-report',compact('totals'));
      }

      return redirect(route('profit-loss-report.index'));
    }
    /*
    *Download profit and loss report
    */
    public function download(Request $request)
    {
      $dt = Carbon::now();

      if($request->duration_sort === 'thisWeek'){
        $startDate =$dt->startOfWeek();
        $endDate = $dt->copy()->endOfWeek();
        $totals = $this->get_totals( $startDate, $endDate, 'dates' );
      }
      elseif($request->duration_sort === 'thisYear') {
        $startDate =$dt->startOfYear();
        $endDate = $dt->copy()->endOfYear();
        $totals = $this->get_totals( $dt->year, '', 'year' );
      }
      elseif($request->duration_sort === 'today'){
        $startDate =$dt->startOfDay();
        $endDate = $dt->copy()->endOfDay();
        $totals = $this->get_totals( $dt->day, '', 'day' );
      }
      elseif($request->duration_sort === 'dates'){
        $startDate = Carbon::now()->startOfMonth();
        if($request->filter_from != ''){ $startDate = Carbon::create($request->filter_from);}
        $endDate = Carbon::now();
        if($request->filter_to != ''){ $endDate =Carbon::create($request->filter_to); }

        $totals = $this->get_totals( $startDate, $endDate, 'dates' );
      }
      else {
        $startDate =$dt->startOfMonth();
        $endDate = $dt->copy()->endOfMonth();
        $totals = $this->get_totals( $dt->month, '', 'dates' );
      }

      $docs = $totals;
      $pdf = PDF::loadView('pdf.profit-loss-report',compact('docs','startDate','endDate'));
      return $pdf->download();
    }

    /*
    *Share profit & loss report
    */
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
      Mail::to($email)->queue(new ProfitLossReport($pathToPDF));
      unlink($pathToPDF);
    }

    public function tmp_pdf_path($duration_sort,$filter_from,$filter_to)
    {
      $dt = Carbon::now();

      if($duration_sort === 'thisWeek'){
        $startDate =$dt->startOfWeek();
        $endDate = $dt->copy()->endOfWeek();
        $totals = $this->get_totals( $startDate, $endDate, 'dates' );
        //$purchases= Purchase::whereDate('created_at','>=', $dt->startOfWeek())->whereDate('created_at','<=', $dt->endOfWeek())->orderBy('created_at','DESC')->get();
      }
      elseif($duration_sort === 'thisYear') {
        $startDate =$dt->startOfYear();
        $endDate = $dt->copy()->endOfYear();
        $totals = $this->get_totals( $dt->year, '', 'year' );
        //$purchases= Purchase::whereYear('created_at', $dt->year)->orderBy('created_at','DESC')->get();
      }
      elseif($duration_sort === 'today'){
        $startDate =$dt->today();
        $endDate = $dt->copy()->today();
        $totals = $this->get_totals( $dt->day, '', 'day' );
        //$purchases= Purchase::whereDay('created_at', $dt->day )->orderBy('created_at','DESC')->get();
      }
      elseif($duration_sort === 'dates'){
        $startDate = Carbon::now()->startOfMonth();
        if($filter_from != ''){ $startDate = Carbon::create($filter_from);}
        $endDate = Carbon::now();
        if($filter_to != ''){ $endDate =Carbon::create($filter_to); }
        $totals = $this->get_totals( $startDate, $endDate, 'dates' );
        //$purchases= Purchase::whereDate('created_at','>=', $startDate)->whereDate('created_at','<=', $endDate)->orderBy('created_at','DESC')->get();
      }
      else {
        $startDate =$dt->startOfMonth();
        $endDate = $dt->copy()->endOfMonth();
        $totals = $this->get_totals( $dt->month, '', 'dates' );
        //$purchases= Purchase::whereMonth('created_at', $dt->month)->orderBy('created_at','DESC')->get();
      }


      $docs = $totals;
      $pdf = PDF::loadView('pdf.profit-loss-report',compact('docs','startDate','endDate'));
      $pathToPDF = 'doc-'.$dt.'.pdf';
      $pdf->save($pathToPDF);
      return $pathToPDF;
    }
}
