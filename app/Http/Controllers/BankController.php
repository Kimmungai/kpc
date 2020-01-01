<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Expense;
use App\Revenue;
use App\Booking;
use App\Purchase;

use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        $bankBal = $this->get_bank_bal();
        $purchases = Purchase::where('paid',1)->paginate(env('ITEMS_PER_PAGE',5),['*'], 'purchases');
        $bookings = Booking::where('paid',1)->paginate(env('ITEMS_PER_PAGE',5),['*'], 'bookings');
        $revenues = Revenue::where('paid',1)->where('booking_id',null)->orderBy('created_at','DESC')->paginate(env('ITEMS_PER_PAGE',5),['*'], 'revenue');
        $expenses = Expense::where('paid',1)->where('purchase_id',null)->orderBy('created_at','DESC')->paginate(env('ITEMS_PER_PAGE',5),['*'], 'expense');
        $totals['booking'] = $this->get_total_revenue_received_from_bookings();
        $totals['revenue'] = $this->get_total_revenue();
        $totals['purchase'] = $this->get_total_paid_to_suppliers();
        $totals['expense'] = $this->get_total_expenses();

        return view('bank.show',compact('bank','expenses','purchases','revenues','bookings','bankBal','totals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        //
    }

    /*
    *Function to get bank balance by calculating expenses and revenues
    */
    private function get_bank_bal()
    {
      $totalExpenses = $this->get_total_expenses() + $this->get_total_paid_to_suppliers();
      $totalRevenue = $this->get_total_revenue() + $this->get_total_revenue_received_from_bookings();


      return $bankBal = $totalRevenue - $totalExpenses;
    }
    /*
    *Function to get total amount paid to suppliers
    */
    protected function get_total_paid_to_suppliers()
    {
      return Purchase::where('paid',1)->get()->sum('amountPaid');
    }

    /*
    *Function to get total expenses
    */
    protected function get_total_expenses()
    {
      return Expense::where('paid',1)->where('purchase_id',null)->get()->sum('total');
    }

    /*
    *Function to get total revenue
    */
    protected function get_total_revenue()
    {
      return Revenue::where('paid',1)->where('booking_id',null)->get()->sum('total');
    }

    /*
    *Function to get total revenue received from bookings
    */
    protected function get_total_revenue_received_from_bookings()
    {
      return Booking::where('paid',1)->get()->sum('bookingAmountReceived');
    }
}
