<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use App\Product;
use App\Expense;
use App\Revenue;
use App\Booking;
use App\Purchase;
use App\DeptSales;
use Carbon\Carbon;
use PDF;
use App\Mail\BalanceSheetReport;

class BalanceSheetReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = $this->get_balance_sheet_data();

       return view('Reports.balance-sheet-report',compact('data'));
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
    *Function to return balance sheet data
    */
    protected function get_balance_sheet_data($startDate=null, $endDate=null, $duration_sort=null)
    {
      $data['fixedAssets'] = $this->get_fixed_assets();
      $data['totalFixedAssets'] = $this->get_value_of_fixed_assets();
      $data['inventory'] = $this->get_value_of_current_assets();
      $data['debtors'] = $this->get_value_of_debtors();
      $data['bankBal'] = $this->get_bank_bal();
      $data['currentAssetsTotal'] = $data['inventory'] + $data['debtors'] + $data['bankBal'];
      $data['totalAssets'] = $data['currentAssetsTotal'] + $data['totalFixedAssets'];
      $data['capital'] = 0;
      $data['nonCurrentLiabilities'] = 0;
      $data['payables'] = $this->get_value_of_creditors();
      $data['currentLiabilitiesTotal'] = $data['payables'];
      $data['totalEquityLiabilities'] = $data['currentLiabilitiesTotal'] + $data['nonCurrentLiabilities'] + $data['capital'];

      return $data;
    }

    /*
    *Function to get fixed assets
    */
    protected function get_fixed_assets()
    {
      return Product::where('type',1)->get();
    }

    /*
    *Function to get total value of fixed assets
    */
    protected function get_value_of_fixed_assets()
    {
      return Product::where('type',1)->sum('cost');
    }

    /*
    *Function to get current assets
    */
    protected function get_current_assets()
    {
      return Product::where('type',2)->get();
    }

    /*
    *Function to get total value of current assets
    */
    protected function get_value_of_current_assets()
    {
      return Product::where('type',2)->sum('cost');
    }

    /*
    *Function to get total debtors
    */
    protected function get_value_of_debtors()
    {
      $debtors = $this->get_total_unpaid_revenue() +  $this->get_total_revenue_unpaid_from_bookings() + $this->get_total_unpaid_sales();
      return $debtors;
    }

    /*
    *Function to get total debtors
    */
    protected function get_value_of_creditors()
    {
      $creditors = $this->get_total_unpaid_expenses() +  $this->get_total_owed_to_suppliers();
      return $creditors;
    }

    /*
    *Function to get total expenses
    */
    protected function get_total_expenses()
    {
      return Expense::where('paid',1)->where('purchase_id',null)->get()->sum('amountPaid');
    }

    /*
    *Function to get total revenue
    */
    protected function get_total_revenue()
    {
      return Revenue::where('paid',1)->where('booking_id',null)->where('dept_sales_id',null)->get()->sum('amountReceived');
    }

    /*
    *Function to get total amount paid to suppliers
    */
    protected function get_total_paid_to_suppliers()
    {
      return Purchase::where('paid',1)->get()->sum('amountPaid');
    }

    /*
    *Function to get total revenue received from bookings
    */
    protected function get_total_revenue_received_from_bookings()
    {
      return Booking::where('paid',1)->get()->sum('bookingAmountReceived');
    }

    /*
    *Function to get total revenue received from deprtment sales
    */
    protected function get_total_sales()
    {
      return DeptSales::where('paid',1)->get()->sum('saleAmountReceived');
    }

    /*
    *Function to get total unpaid expenses
    */
    protected function get_total_unpaid_expenses()
    {
      return Expense::where('paid','<>',1)->where('purchase_id',null)->get()->sum('total');
    }

    /*
    *Function to get total unpaid revenue
    */
    protected function get_total_unpaid_revenue()
    {
      return Revenue::where('paid','<>',1)->where('booking_id',null)->where('dept_sales_id',null)->get()->sum('total');
    }

    /*
    *Function to get total amount owed to suppliers
    */
    protected function get_total_owed_to_suppliers()
    {
      return Purchase::where('paid','<>',1)->get()->sum('amountDue');
    }

    /*
    *Function to get total revenue unpaid from bookings
    */
    protected function get_total_revenue_unpaid_from_bookings()
    {
      return Booking::where('paid','<>',1)->get()->sum('bookingAmountDue') - Booking::where('paid','<>',1)->get()->sum('bookingAmountReceived');
    }

    /*
    *Function to get total revenue unpaid from deprtment sales
    */
    protected function get_total_unpaid_sales()
    {
      return DeptSales::where('paid','<>',1)->get()->sum('saleAmountDue') - DeptSales::where('paid','<>',1)->get()->sum('saleAmountReceived');
    }

    /*
    *Function to get bank balance by calculating expenses and revenues
    */
    private function get_bank_bal()
    {
      $totalExpenses = $this->get_total_expenses() + $this->get_total_paid_to_suppliers();
      $totalRevenue = $this->get_total_revenue() + $this->get_total_revenue_received_from_bookings() + $this->get_total_sales();


      return $bankBal = $totalRevenue - $totalExpenses;
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
        $data = $this->get_balance_sheet_data($startDate, $endDate, 'dates');
      }
      elseif($request->duration_sort === 'thisYear') {
        $startDate =$dt->startOfYear();
        $endDate = $dt->copy()->endOfYear();
        $data = $this->get_balance_sheet_data($startDate, $endDate, 'year');
      }
      elseif($request->duration_sort === 'today'){
        $startDate =$dt->startOfDay();
        $endDate = $dt->copy()->endOfDay();
        $data = $this->get_balance_sheet_data($startDate, $endDate, 'day');
      }
      elseif($request->duration_sort === 'dates'){
        $startDate = Carbon::now()->startOfMonth();
        if($request->filter_from != ''){ $startDate = Carbon::create($request->filter_from);}
        $endDate = Carbon::now();
        if($request->filter_to != ''){ $endDate =Carbon::create($request->filter_to); }
        $data = $this->get_balance_sheet_data($startDate, $endDate, 'dates');
      }
      else {
        $startDate =$dt->startOfMonth();
        $endDate = $dt->copy()->endOfMonth();
        $data = $this->get_balance_sheet_data($startDate, $endDate, 'dates');
      }

      $docs = $data;
      $pdf = PDF::loadView('pdf.balance-sheet-report',compact('docs','startDate','endDate'));
      return $pdf->download();
    }

    /*
    *Share profit & loss report
    */
    public function share(Request $request)
    {
      $request->validate([
        'email' => 'required|email|max:255',
        'duration_sort' => 'nullable|max:255',
        'filter_from' => 'nullable|max:255',
        'filter_to' => 'nullable|max:255',
      ]);

      $email = $request->email;
      $duration_sort =$request->duration_sort;
      $filter_from =$request->filter_from;
      $filter_to = $request->filter_to;

      //send email
      $pathToPDF = $this->tmp_pdf_path($duration_sort,$filter_from,$filter_to);
      Mail::to($email)->send(new BalanceSheetReport($pathToPDF));
      unlink($pathToPDF);
    }

    public function tmp_pdf_path($duration_sort,$filter_from,$filter_to)
    {
      $dt = Carbon::now();

      if($duration_sort === 'thisWeek'){
        $startDate =$dt->startOfWeek();
        $endDate = $dt->copy()->endOfWeek();
        $data = $this->get_balance_sheet_data($startDate, $endDate, 'dates');
        //$purchases= Purchase::whereDate('created_at','>=', $dt->startOfWeek())->whereDate('created_at','<=', $dt->endOfWeek())->orderBy('created_at','DESC')->get();
      }
      elseif($duration_sort === 'thisYear') {
        $startDate =$dt->startOfYear();
        $endDate = $dt->copy()->endOfYear();
        $data = $this->get_balance_sheet_data($startDate, $endDate, 'year');
      }
      elseif($duration_sort === 'today'){
        $startDate =$dt->today();
        $endDate = $dt->copy()->today();
        $data = $this->get_balance_sheet_data($startDate, $endDate, 'day');
      }
      elseif($duration_sort === 'dates'){
        $startDate = Carbon::now()->startOfMonth();
        if($filter_from != ''){ $startDate = Carbon::create($filter_from);}
        $endDate = Carbon::now();
        if($filter_to != ''){ $endDate =Carbon::create($filter_to); }
        $data = $this->get_balance_sheet_data($startDate, $endDate, 'year');
      }
      else {
        $startDate =$dt->startOfMonth();
        $endDate = $dt->copy()->endOfMonth();
        $data = $this->get_balance_sheet_data($startDate, $endDate, 'year');
      }


      $docs = $data;
      $pdf = PDF::loadView('pdf.balance-sheet-report',compact('docs','startDate','endDate'));
      $pathToPDF = 'doc-'.$dt.'.pdf';
      $pdf->save($pathToPDF);
      return $pathToPDF;
    }
}
