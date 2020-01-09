<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use App\Revenue;
use App\Dept;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
      $sortField='created_at';$sortValue='DESC';
      $status =' id != "" ';
      $sortBy = $request->filter_sort;
      $startDate = $request->filter_from != null ?  Carbon::create($request->filter_from) : null;
      $endDate = $request->filter_to != null ?  Carbon::create($request->filter_to) : null;
      if($sortBy)
      {
        if( $sortBy == 'oldNew' ){$sortField='created_at';$sortValue='ASC';}
        if( $sortBy == 'paidOnly' ){ $status ='balance <= 0'; }
        if( $sortBy == 'pendingOnly' ){ $status ='balance > 0'; }
        if( $sortBy == 'overPaidOnly' ){ $status ='balance < 0'; }
      }

      if(Session('deptID') != null ){
        $dept = Dept::find(Session('deptID'));
        if( $startDate && $endDate)
        {

          $revenue = Revenue::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereDate('created_at','>=',$startDate)->whereDate('created_at','<=',$endDate)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

        }elseif($startDate){

          $revenue = Revenue::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereDate('created_at','>=',$startDate)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

        }else{

          $revenue = Revenue::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

        }
        return view('revenue.index',compact('revenue','dept','sortBy','startDate','endDate'));
      }else{

        $revenue = Revenue::paginate(env('ITEMS_PER_PAGE',5));

      }

      return view('revenue.index',compact('revenue','sortBy','startDate','endDate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dept = Dept::find(Session('deptID'));
        return view('revenue.create',compact('dept'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validated = $this->validate_revenue($request);
      $validated['balance'] = $validated['amountDue'] - $validated['amountReceived'];

      if( $validated['balance'] <= 0 )
        $validated['paid'] = 1;
      else
        $validated['paid'] = 0;


      $revenue = Revenue::create($validated);
      Session::flash('message', env("SAVE_SUCCESS_MSG","Details saved succesfully!"));
      return redirect(route('revenue.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function show(Revenue $revenue)
    {
      $dept = Dept::find(Session('deptID'));
      return view('revenue.show',compact('dept','revenue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function edit(Revenue $revenue)
    {
      $dept = Dept::find(Session('deptID'));
      return view('revenue.edit',compact('dept','revenue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Revenue $revenue)
    {
        $validated = $this->validate_revenue($request);
        $validated['amountReceived'] += $revenue->amountReceived;
        $validated['balance'] = $validated['amountDue'] - $validated['amountReceived'];

        if( $validated['balance'] <= 0 )
          $validated['paid'] = 1;
        else
          $validated['paid'] = 0;


        $revenue->update($validated);
        Session::flash('message', env("SAVE_SUCCESS_MSG","Details saved succesfully!"));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Revenue $revenue)
    {
        $revenue->forceDelete();
        Session::flash('message', env("DELETE_SUCCESS_MSG","Records removed succesfully!"));
        return redirect(route('revenue.index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function revenue_payment(Request $request, Revenue $revenue)
    {
      $validated = $request->validate([
         'amountReceived' => 'required|numeric',
         'modeOfPayment' => 'nullable|numeric',
         'transactionCode' =>'nullable'
       ]);
      $validated['amountReceived'] += $revenue->amountReceived;
      $validated['balance'] = $revenue->amountDue - $validated['amountReceived'];

      if( $validated['balance'] <= 0 )
        $validated['paid'] = 1;
      else
        $validated['paid'] = 0;


      $revenue->update($validated);
      Session::flash('message', env("SAVE_SUCCESS_MSG","Details saved succesfully!"));
      return back();
    }
    /**
    *Validate revenue request data
    *
    *@param $request
    *@return $validated
    */
    private function validate_revenue($request)
    {
      $validated = $request->validate([
         'title' => 'required',
         'dept_id' => 'required|numeric',
         'description' => 'nullable',
         'amountDue' => 'required|numeric',
         'amountReceived' => 'nullable|numeric',
         'paymentDueDate' => 'nullable',
         'modeOfPayment' => 'nullable|numeric',
         'transactionCode' =>'nullable'
       ]);
      return $validated;
    }
}
